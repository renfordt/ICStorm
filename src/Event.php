<?php

namespace renfordt\ICStorm;

use DateTime;
use Exception;

class Event
{
    private string $description;
    private string $location;
    private DateTime $startDate;
    private DateTime $endDate;
    private string $title;
    private string $summary;
    private EventClassification $class = EventClassification::private;
    private EventTransparency $transparency = EventTransparency::opaque;
    private string $conference;

    /**
     * Creates a new Event object with the given details.
     *
     * @param  array  $details  The details for the event.
     * @return Event The created Event object.
     * @throws Exception If the 'startDate' or 'endDate' is not provided in the details array.
     */
    public static function createEvent(array $details): Event
    {
        if (!isset($details['startDate']) || !isset($details['endDate'])) {
            throw new Exception('startDate and endDate are required.');
        }

        $event = new Event();
        $event->setStartDate($details['startDate']);
        $event->setEndDate($details['endDate']);

        unset($details['startDate'], $details['endDate']); // These have already been set

        foreach ($details as $property => $value) {
            $event->setPropertyIfExists($details, $property);
        }

        return $event;
    }

    /**
     * Sets the value of a property if it exists in the details array.
     *
     * @param  array  $details  The details array.
     * @param  string  $property  The name of the property.
     * @return void
     */
    private function setPropertyIfExists(array $details, string $property): void
    {
        $methodName = 'set'.ucfirst($property);
        if (isset($details[$property]) && method_exists($this, $methodName)) {
            $this->$methodName($details[$property]);
        }
    }

    /**
     * Get the description of the event.
     *
     * @return string The description of the event.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description for the event.
     *
     * @param  string  $description  The description for the event.
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get the location of the object.
     *
     * @return string The location of the object as a string.
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Set the location of the object.
     *
     * @param  string  $location  The location to set.
     * @return void
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * Get the start date of the object.
     *
     * @return string The start date of the object formatted as 'Ymd\THis\Z'.
     */
    public function getStartDate(): string
    {
        return $this->startDate->format('Ymd\THis\Z');
    }

    /**
     * Set the start date.
     *
     * @param  DateTime|string  $startDate  The start date as a DateTime object or a string in a format supported by DateTime constructor.
     * @return void
     */
    public function setStartDate(DateTime|string $startDate): void
    {
        if (is_string($startDate)) {
            $startDate = new DateTime($startDate);
        }
        $this->startDate = $startDate;
    }

    /**
     * Get the formatted end date.
     *
     * @return string The formatted end date in Ymd\THis\Z format.
     */
    public function getEndDate(): string
    {
        return $this->endDate->format('Ymd\THis\Z');
    }

    /**
     * Sets the end date.
     *
     * @param  DateTime|string  $endDate  The end date to set.
     *
     * @return void
     */
    public function setEndDate(DateTime|string $endDate): void
    {
        if (is_string($endDate)) {
            $endDate = new DateTime($endDate);
        }
        $this->endDate = $endDate;
    }

    /**
     * Get the title of the object.
     *
     * @return string The title of the object.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title of the object
     *
     * @param  string  $title  The title to set
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Gets the summary of the object
     *
     * @return string  The summary of the object
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * Sets the summary of the object
     *
     * @param  string  $summary  The summary to set
     * @return void
     */
    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * Get the classification of the event.
     *
     * @return EventClassification Returns the EventClassification object representing the classification of the event.
     */
    public function getClassification(): EventClassification
    {
        return $this->class;
    }

    /**
     * Sets the event classification for the object
     *
     * @param  EventClassification  $class  The event classification to set
     * @return void
     */
    public function setClass(EventClassification $class): void
    {
        $this->class = $class;
    }

    /**
     * Returns the transparency of the event
     *
     * @return EventTransparency  The transparency of the event
     */
    public function getTransparency(): EventTransparency
    {
        return $this->transparency;
    }

    /**
     * Sets the transparency of the event
     *
     * @param  EventTransparency  $transparency  The transparency to set
     * @return void
     */
    public function setTransparency(EventTransparency $transparency): void
    {
        $this->transparency = $transparency;
    }
}
