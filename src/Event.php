<?php

namespace renfordt\ICStorm;

use DateTime;
use DateTimeZone;
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
     * Sets the event classification for the object
     *
     * @param  EventClassification  $class  The event classification to set
     * @return void
     */
    public function setClass(EventClassification $class): void
    {
        $this->class = $class;
    }

    public function generateICS(): string
    {
        $ics = "BEGIN:VEVENT\r\n";
        $ics .= "UID:".uniqid(more_entropy: true)."\r\n";
        $ics .= "DTSTAMP:".date('Ymd\THis')."\r\n";
        $ics .= "DTSTART:".$this->getStartDate()."\r\n";
        $ics .= "DTEND:".$this->getEndDate()."\r\n";
        $ics .= "SUMMARY:".$this->getTitle()."\r\n";
        $ics .= "DESCRIPTION:".$this->getDescription()."\r\n";
        $ics .= "LOCATION:".$this->getLocation()."\r\n";
        $ics .= "CLASS:".$this->getClassification()->value."\r\n";
        $ics .= "TRANSP:".$this->getTransparency()->value."\r\n";
        $ics .= "END:VEVENT\r\n";

        return $ics;
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
     * Sets the start date of the object
     *
     * @param  DateTime|string  $startDate  The start date to set
     * @param  DateTimeZone|string  $timezone  The timezone to set the start date in (default: 'UTC')
     * @return void
     */
    public function setStartDate(DateTime|string $startDate, DateTimeZone|string $timezone = 'UTC'): void
    {
        $this->startDate = $this->setDate($startDate, $timezone);
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
     * Sets the end date of the object
     *
     * @param  DateTime|string  $endDate  The end date to set
     * @param  DateTimeZone|string  $timezone  The timezone for the end date (default: 'UTC')
     * @return void
     */
    public function setEndDate(DateTime|string $endDate, DateTimeZone|string $timezone = 'UTC'): void
    {
        $this->endDate = $this->setDate($endDate, $timezone);
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
     * Get the classification of the event.
     *
     * @return EventClassification Returns the EventClassification object representing the classification of the event.
     */
    public function getClassification(): EventClassification
    {
        return $this->class;
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

    /**
     * Sets the date and timezone of the object and returns the DateTime object in UTC timezone
     *
     * @param  DateTime|string  $date  The date to set (can be a DateTime object or a string representation of a date)
     * @param  DateTimeZone|string  $timezone  The timezone to set (can be a DateTimeZone object or a string representation of a timezone)
     * @return DateTime  The DateTime object in UTC timezone
     * @throws Exception
     */
    protected function setDate(DateTime|string $date, DateTimeZone|string $timezone = 'UTC'): DateTime
    {
        if (is_string($timezone)) {
            $timezone = new DateTimeZone($timezone);
        }

        if (is_string($date)) {
            $date = new DateTime($date, $timezone);
        }
        if ($date instanceof DateTime) {
                $date = new DateTime($date->format('Y-m-d H:i:s'), $timezone);
        }

        return $date->setTimezone(new DateTimeZone("UTC"));
    }
}
