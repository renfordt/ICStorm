<?php

namespace renfordt\ICStorm;

use DateTimeZone;

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
            $ics .= $event->generateICS();
        }
        $ics .= "END:VCALENDAR\r\n";
        return $ics;
    }
}
