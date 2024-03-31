<?php

namespace renfordt\ICStorm;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calendar::class)]
#[UsesClass(Event::class)]
class CalendarTest extends TestCase
{

    public function testGenerateICS()
    {
        $title = 'Test Event';
        $summary = 'Test Event';
        $description = 'This is a test event';
        $startDate = '2024-10-15 18:15:00';
        $endDate = '2024-10-15 18:45:00';
        $classification = EventClassification::private;
        $transparency = EventTransparency::opaque;
        $location = 'Test Location';

        $event = Event::createEvent(
            compact('title',
                'summary',
                'description',
                'startDate',
                'endDate',
                'classification',
                'transparency',
                'location'));

        $calendar = new Calendar();
        $calendar->addEvent($event);

        $startDateTime = new \DateTime($startDate);
        $endDateTime = new \DateTime($endDate);

        $ics = $calendar->generateICS();
        $this->assertStringStartsWith("BEGIN:VCALENDAR", $ics);
        $this->assertStringEndsWith("END:VCALENDAR\r\n", $ics);
        $this->assertStringContainsString("BEGIN:VEVENT", $ics);
        $this->assertStringContainsString("SUMMARY:$title", $ics);
        $this->assertStringContainsString("DESCRIPTION:$description", $ics);
        $this->assertStringContainsString("LOCATION:$location", $ics);
        $this->assertStringContainsString("DTSTART:".$startDateTime->format('Ymd\THis'), $ics);
        $this->assertStringContainsString("DTEND:".$endDateTime->format('Ymd\THis'), $ics);
        $this->assertStringContainsString("CLASS:".$classification->value, $ics);
        $this->assertStringContainsString("TRANSP:".$transparency->value, $ics);
        $this->assertStringContainsString("END:VEVENT", $ics);
    }
    public function testGenerateICSFile()
    {
        $title = 'Test Event 2';
        $summary = 'Test Event 2';
        $description = 'This is a test event';
        $startDate = '2024-03-28 22:00:00';
        $endDate = '2024-03-28 23:00:00';
        $classification = EventClassification::private;
        $transparency = EventTransparency::opaque;
        $location = 'Test Location in a different country';
        $filename = 'test_calendar.ics';

        $event = Event::createEvent(
            compact('title',
                'summary',
                'description',
                'startDate',
                'endDate',
                'classification',
                'transparency',
                'location'));

        $calendar = new Calendar();
        $calendar->addEvent($event);

        $file = $calendar->generateICSFile($filename);
        $this->assertEquals($filename, $file);
        $this->assertFileExists($file);
        $ics = file_get_contents($file);

        $this->assertStringStartsWith("BEGIN:VCALENDAR", $ics);
        $this->assertStringEndsWith("END:VCALENDAR\r\n", $ics);
        $this->assertStringContainsString("BEGIN:VEVENT", $ics);
        $this->assertStringContainsString("SUMMARY:$title", $ics);
        $this->assertStringContainsString("DESCRIPTION:$description", $ics);
        $this->assertStringContainsString("LOCATION:$location", $ics);
        $this->assertStringContainsString("DTSTART:".date('Ymd\THis', strtotime($startDate)), $ics);
        $this->assertStringContainsString("DTEND:".date('Ymd\THis', strtotime($endDate)), $ics);
        $this->assertStringContainsString("CLASS:".$classification->value, $ics);
        $this->assertStringContainsString("TRANSP:".$transparency->value, $ics);
        $this->assertStringContainsString("END:VEVENT", $ics);

        // Cleanup
        unlink($file);
    }
}
