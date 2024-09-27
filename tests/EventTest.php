<?php

namespace renfordt\ICStorm;

use Error;
use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * Class EventTest
 * @package renfordt\ICStorm
 *
 * This class provides tests for the Event class, primarily focusing on the getDescription method.
 */
#[CoversClass(Event::class)]
class EventTest extends TestCase
{
    /**
     * Test getDescription method
     */
    public function testGetDescription(): void
    {
        $event = new Event();
        $description = "This is a test event";
        $event->setDescription($description);
        $this->assertEquals($description, $event->getDescription());
    }

    /**
     * Test getDescription with empty description
     */
    public function testGetDescriptionWithEmptyDescription(): void
    {
        $event = new Event();
        $description = "";
        $event->setDescription($description);
        $this->assertEquals($description, $event->getDescription());
    }

    /**
     * Test getLocation method
     */
    public function testGetLocation(): void
    {
        $event = new Event();
        $location = "1234 Test St, Testing, TS";
        $event->setLocation($location);
        $this->assertEquals($location, $event->getLocation());
    }

    /**
     * Test getLocation with empty location
     */
    public function testGetLocationWithEmptyLocation(): void
    {
        $event = new Event();
        $location = "";
        $event->setLocation($location);
        $this->assertEquals($location, $event->getLocation());
    }

    /**
     * Test getTitle method with some title
     */
    public function testGetTitle(): void
    {
        $event = new Event();
        $title = "Test Event";
        $event->setTitle($title);
        $this->assertEquals($title, $event->getTitle());
    }

    /**
     * Test getTitle with empty title
     */
    public function testGetTitleWithEmptyTitle(): void
    {
        $event = new Event();
        $title = "";
        $event->setTitle($title);
        $this->assertEquals($title, $event->getTitle());
    }

    /**
     * Test getSummary method
     */
    public function testGetSummary(): void
    {
        $event = new Event();
        $summary = "This is a summary for a test event";
        $event->setSummary($summary);
        $this->assertEquals($summary, $event->getSummary());
    }

    /**
     * Test getSummary with empty summary
     */
    public function testGetSummaryWithEmptySummary(): void
    {
        $event = new Event();
        $summary = "";
        $event->setSummary($summary);
        $this->assertEquals($summary, $event->getSummary());
    }

    /**
     * Test getClassification method - expecting private by default
     */
    public function testGetClassificationDefault(): void
    {
        $event = new Event();
        $classification = EventClassificationEnum::private;
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getClassification method - setting to public
     */
    public function testGetClassificationPublic(): void
    {
        $event = new Event();
        $classification = EventClassificationEnum::public;
        $event->setClass($classification);
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getClassification method - setting to confidential
     */
    public function testGetClassificationConfidential(): void
    {
        $event = new Event();
        $classification = EventClassificationEnum::confidential;
        $event->setClass($classification);
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getTransparency method - expecting Opaque by default
     */
    public function testGetTransparencyDefault(): void
    {
        $event = new Event();
        $transparency = EventTransparencyEnum::opaque;
        $this->assertEquals($transparency, $event->getTransparency());
    }

    /**
     * Test getTransparency method - setting to Transparent
     */
    public function testGetTransparencyTransparent(): void
    {
        $event = new Event();
        $transparency = EventTransparencyEnum::transparent;
        $event->setTransparency($transparency);
        $this->assertEquals($transparency, $event->getTransparency());
    }

    /**
     * Test getStartDate method with DateTime object
     */
    public function testGetStartDate(): void
    {
        $event = new Event();
        $startDate = new \DateTime('2022-04-01 12:00:00');
        $event->setStartDate($startDate);
        $this->assertEquals('20220401T120000Z', $event->getStartDate());
    }

    /**
     * Test getStartDate method with string
     */
    public function testGetStartDateWithString(): void
    {
        $event = new Event();
        $startDate = '2024-03-28 14:23:15';
        $event->setStartDate($startDate);
        $this->assertEquals('20240328T142315Z', $event->getStartDate());
    }

    /**
     * Test getEndDate method with DateTime object
     */
    public function testGetEndDate(): void
    {
        $event = new Event();
        $endDate = new \DateTime('2022-04-02 18:00:00');
        $event->setEndDate($endDate);
        $this->assertEquals('20220402T180000Z', $event->getEndDate());
    }

    /**
     * Test getEndDate method with string
     */
    public function testGetEndDateWithString(): void
    {
        $event = new Event();
        $endDate = '2024-03-30 16:23:15';
        $event->setEndDate($endDate);
        $this->assertEquals('20240330T162315Z', $event->getEndDate());
    }

    /**
     * Test createEvent method with all properties
     */
    public function testCreateEventWithAllProperties(): void
    {
        $details = [
            'description' => 'Event Description',
            'location' => 'Event Location',
            'startDate' => '2022-01-01 00:00:00',
            'endDate' => '2022-01-01 12:00:00',
            'title' => 'Event Title',
            'summary' => 'Event Summary',
            'class' => EventClassificationEnum::public,
            'transparency' => EventTransparencyEnum::transparent
        ];

        $event = Event::create($details);

        $this->assertEquals($details['description'], $event->getDescription());
        $this->assertEquals($details['location'], $event->getLocation());
        $this->assertEquals('20220101T000000Z', $event->getStartDate());
        $this->assertEquals('20220101T120000Z', $event->getEndDate());
        $this->assertEquals($details['title'], $event->getTitle());
        $this->assertEquals($details['summary'], $event->getSummary());
        $this->assertEquals($details['class'], $event->getClassification());
        $this->assertEquals($details['transparency'], $event->getTransparency());
    }

    /**
     * Test createEvent method without startDate and endDate, expects Exception
     */
    public function testCreateEventWithoutDates(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('startDate and endDate are required.');

        $details = [
            'description' => 'Event Description',
            'location' => 'Event Location',
            'title' => 'Event Title',
            'summary' => 'Event Summary',
            'class' => EventClassificationEnum::public,
            'transparency' => EventTransparencyEnum::transparent
        ];

        Event::create($details);
    }

    /**
     * Test setDate with DateTime object and string timezone
     */
    public function testSetDateWithDateTimeAndStringTimezone(): void
    {
        $event = new Event();
        $date = new \DateTime('2022-04-01 12:00:00');
        $timezone = 'America/New_York';
        $event->setStartDate($date, $timezone);
        $expectedDate = new \DateTime('2022-04-01 12:00:00', new \DateTimeZone(($timezone)));
        $expectedDate->setTimezone(new \DateTimeZone('UTC'));
        $this->assertEquals($expectedDate->format('Ymd\THis\Z'), $event->getStartDate());
    }

    /**
     * Test setDate with string date and string timezone
     */
    public function testSetDateWithStringDateAndStringTimezone(): void
    {
        $event = new Event();
        $date = '2022-04-01 12:00:00';
        $timezone = 'America/New_York';
        $event->setStartDate($date, $timezone);
        $expectedDate = new \DateTime($date, new \DateTimeZone($timezone));
        $expectedDate->setTimezone(new \DateTimeZone('UTC'));
        $this->assertEquals($expectedDate->format('Ymd\THis\Z'), $event->getStartDate());
    }

    /**
     * Test setDate with DateTime object and DateTimeZone object
     */
    public function testSetDateWithDateTimeAndDateTimeZone(): void
    {
        $event = new Event();
        $date = new \DateTime('2022-04-01 12:00:00');
        $timezone = new \DateTimeZone('America/New_York');
        $event->setStartDate($date, $timezone);
        $expectedDate = new \DateTime('2022-04-01 12:00:00', $timezone);
        $expectedDate->setTimezone(new \DateTimeZone('UTC'));
        $this->assertEquals($expectedDate->format('Ymd\THis\Z'), $event->getStartDate());
    }

    /**
     * Test setDate method with invalid string date and valid string timezone
     */
    public function testSetDateWithInvalidStringDateAndStringTimezone(): void
    {
        $this->expectException(Exception::class);
        $event = new Event();
        $date = 'Invalid Date';
        $timezone = 'America/New_York';
        $event->setStartDate($date, $timezone);
    }

    /**
     * Test setDate method with valid string date and invalid string timezone
     */
    public function testSetDateWithStringDateAndInvalidStringTimezone(): void
    {
        $this->expectException(Exception::class);
        $event = new Event();
        $date = '2022-04-01 12:00:00';
        $timezone = 'Invalid Timezone';
        $event->setStartDate($date, $timezone);
    }
    /**
     * Test generateICS method
     */
    public function testGenerateICS(): void
    {
        $event = new Event();
        $description = "Test event description";
        $location = "Test location";
        $startDate = '2022-03-15 09:00:00';
        $endDate = '2022-03-15 17:00:00';
        $title = "Test title";
        $summary = "Test event summary";
        $classification = EventClassificationEnum::public;
        $transparency = EventTransparencyEnum::transparent;

        $event->setDescription($description);
        $event->setLocation($location);
        $event->setStartDate($startDate);
        $event->setEndDate($endDate);
        $event->setTitle($title);
        $event->setSummary($summary);
        $event->setClass($classification);
        $event->setTransparency($transparency);

        $generatedICS = $event->generateICS();

        $this->assertStringContainsString("BEGIN:VEVENT", $generatedICS);
        $this->assertStringContainsString("UID:", $generatedICS);
        $this->assertStringContainsString("DTSTAMP:", $generatedICS);
        $this->assertStringContainsString("DTSTART:20220315T090000Z", $generatedICS);
        $this->assertStringContainsString("DTEND:20220315T170000Z", $generatedICS);
        $this->assertStringContainsString("SUMMARY:Test title", $generatedICS);
        $this->assertStringContainsString("DESCRIPTION:Test event description", $generatedICS);
        $this->assertStringContainsString("LOCATION:Test location", $generatedICS);
        $this->assertStringContainsString("CLASS:PUBLIC", $generatedICS);
        $this->assertStringContainsString("TRANSP:TRANSPARENT", $generatedICS);
        $this->assertStringContainsString("END:VEVENT", $generatedICS);
    }
}
