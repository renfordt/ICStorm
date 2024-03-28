<?php

namespace renfordt\ICStorm;

class Calendar
{
    protected array $events;

    public function addEvent(Event $event): void
    {
        $this->events[] = $event;
    }

    public function generateICSFile(string $file = 'calendar.ics'): string
    {
        $ics = $this->generateICS();
        file_put_contents($file, $ics);
        return $file;
    }

    public function generateICS(): string
    {
        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//ICStorm//EN\r\n";
        foreach ($this->events as $event) {
            $ics .= "BEGIN:VEVENT\r\n";
            $ics .= "UID:".uniqid()."\r\n";
            $ics .= "DTSTAMP:".date('Ymd\THis\Z')."\r\n";
            $ics .= "DTSTART:".$event->getStartDate()->format('Ymd\THis\Z')."\r\n";
            $ics .= "DTEND:".$event->getEndDate()->format('Ymd\THis\Z')."\r\n";
            $ics .= "SUMMARY:".$event->getTitle()."\r\n";
            $ics .= "DESCRIPTION:".$event->getDescription()."\r\n";
            $ics .= "LOCATION:".$event->getLocation()."\r\n";
            $ics .= "CLASS:".$event->getClassification()."\r\n";
            $ics .= "TRANSP:".$event->getTransparency()."\r\n";
            $ics .= "END:VEVENT\r\n";
        }
        $ics .= "END:VCALENDAR\r\n";
        return $ics;
    }
}
