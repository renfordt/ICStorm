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
        $classification = EventClassification::Private;
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getClassification method - setting to public
     */
    public function testGetClassificationPublic(): void
    {
        $event = new Event();
        $classification = EventClassification::Public;
        $event->setClass($classification);
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getClassification method - setting to confidential
     */
    public function testGetClassificationConfidential(): void
    {
        $event = new Event();
        $classification = EventClassification::Confidential;
        $event->setClass($classification);
        $this->assertEquals($classification, $event->getClassification());
    }

    /**
     * Test getTransparency method - expecting Opaque by default
     */
    public function testGetTransparencyDefault(): void
    {
        $event = new Event();
        $transparency = EventTransparency::Opaque;
        $this->assertEquals($transparency, $event->getTransparency());
    }

    /**
     * Test getTransparency method - setting to Transparent
     */
    public function testGetTransparencyTransparent(): void
    {
        $event = new Event();
        $transparency = EventTransparency::Transparent;
        $event->setTransparency($transparency);
        $this->assertEquals($transparency, $event->getTransparency());
    }

}
