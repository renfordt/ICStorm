# ICStorm
___
[![Badge](http://img.shields.io/badge/source-renfordt/ICStorm-blue.svg)](https://github.com/renfordt/ICStorm)
[![Packagist Version](https://img.shields.io/packagist/v/renfordt/icstorm?include_prereleases)](https://packagist.org/packages/renfordt/icstorm/)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/renfordt/icstorm/php)
![Packagist License](https://img.shields.io/packagist/l/renfordt/icstorm)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/renfordt/ICStorm/php.yml?logo=github)
[![Code Climate coverage](https://img.shields.io/codeclimate/coverage/renfordt/ICStorm?logo=codeclimate)](https://codeclimate.com/github/renfordt/ICStorm/test_coverage)
[![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability/renfordt/ICStorm?logo=codeclimate)](https://codeclimate.com/github/renfordt/ICStorm/maintainability)

ICStorm is a package for creating ICS files with one or multiple events.

## Installation
```
composer require renfordt/icstorm
```

## Usage

```php
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

$ics = $calendar->generateICS(); // generates a ICS string
$icsFile = $calendar->generateICSFile(); // generates a ICS file
```