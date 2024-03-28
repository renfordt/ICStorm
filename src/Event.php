<?php

namespace renfordt\ICStorm;

class Event
{
    private string $description;
    private string $location;
    private \DateTime $startDate;
    private \DateTime $endDate;
    private string $title;
    private string $summary;
    private EventClassification $class = EventClassification::Private;
    private EventTransparency $transparency = EventTransparency::Opaque;


    private string $conference;


    public function setDetails(array $details): void
    {

    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getStartDate(): string
    {
        return $this->startDate->format('Ymd\THis\Z');;
    }

    public function setStartDate(\DateTime|string $startDate): void
    {
        if(is_string($startDate)) {
            $startDate = new \DateTime($startDate);
        }
        $this->startDate = $startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate->format('Ymd\THis\Z');
    }

    public function setEndDate(\DateTime|string $endDate): void
    {
        if(is_string($endDate)) {
            $endDate = new \DateTime($endDate);
        }
        $this->endDate = $endDate;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getClassification(): EventClassification
    {
        return $this->class;
    }

    public function setClass(EventClassification $class): void
    {
        $this->class = $class;
    }

    public function getTransparency(): EventTransparency
    {
        return $this->transparency;
    }

    public function setTransparency(EventTransparency $transparency): void
    {
        $this->transparency = $transparency;
    }


}