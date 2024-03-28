<?php

namespace renfordt\ICStorm;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calendar::class)]
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
        $this->assertStringContainsString("DTSTART:".$startDateTime->format('Ymd\THis\Z'), $ics);
        $this->assertStringContainsString("DTEND:".$endDateTime->format('Ymd\THis\Z'), $ics);
        $this->assertStringContainsString("CLASS:".$classification->value, $ics);
        $this->assertStringContainsString("TRANSP:".$transparency->value, $ics);
        $this->assertStringContainsString("END:VEVENT", $ics);
    }
}
