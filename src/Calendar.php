<?php

namespace renfordt\ICStorm;

class Calendar
{
    protected array $events;

    /**
     * Adds an event to the calendar.
     *
     * @param  Event  $event  The event to be added.
     * @return void
     */
    public function addEvent(Event $event): void
    {
        $this->events[] = $event;
    }

    /**
     * Generates an ICS file and saves it to the specified file
     *
     * @param  string  $file  The name of the ICS file to be generated. Default is 'calendar.ics'
     * @return string The name of the generated ICS file
     */
    public function generateICSFile(string $file = 'calendar.ics'): string
    {
        $ics = $this->generateICS();
        file_put_contents($file, $ics);
        return $file;
    }

    /**
     * Generates an iCalendar in string format.
     *
     * @return string The generated iCalendar string.
     */
    public function generateICS(): string
    {
        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//ICStorm//EN\r\n";
        foreach ($this->events as $event) {
            $ics .= "BEGIN:VEVENT\r\n";
            $ics .= "UID:".uniqid()."\r\n";
            $ics .= "DTSTAMP:".date('Ymd\THis\Z')."\r\n";
            $ics .= "DTSTART:".$event->getStartDate()."\r\n";
            $ics .= "DTEND:".$event->getEndDate()."\r\n";
            $ics .= "SUMMARY:".$event->getTitle()."\r\n";
            $ics .= "DESCRIPTION:".$event->getDescription()."\r\n";
            $ics .= "LOCATION:".$event->getLocation()."\r\n";
            $ics .= "CLASS:".$event->getClassification()->value."\r\n";
            $ics .= "TRANSP:".$event->getTransparency()->value."\r\n";
            $ics .= "END:VEVENT\r\n";
        }
        $ics .= "END:VCALENDAR\r\n";
        return $ics;
    }
}
