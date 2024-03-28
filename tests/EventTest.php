<?php

namespace renfordt\ICStorm;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

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
        $classification = EventClassification::private;
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getClassification method - setting to public
     */
    public function testGetClassificationPublic(): void
    {
        $event = new Event();
        $classification = EventClassification::public;
        $event->setClass($classification);
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getClassification method - setting to confidential
     */
    public function testGetClassificationConfidential(): void
    {
        $event = new Event();
        $classification = EventClassification::confidential;
        $event->setClass($classification);
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getTransparency method - expecting Opaque by default
     */
    public function testGetTransparencyDefault(): void
    {
        $event = new Event();
        $transparency = EventTransparency::opaque;
        $this->assertEquals($transparency, $event->getTransparency());
    }

    /**
     * Test getTransparency method - setting to Transparent
     */
    public function testGetTransparencyTransparent(): void
    {
        $event = new Event();
        $transparency = EventTransparency::transparent;
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
}
