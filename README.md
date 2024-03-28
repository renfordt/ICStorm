# ICStorm
___
[![Badge](http://img.shields.io/badge/source-renfordt/ICStorm-blue.svg)](https://github.com/renfordt/ICStorm)
[![Latest Version](https://img.shields.io/packagist/v/renfordt/icstorm?label=version)](https://packagist.org/packages/renfordt/icstorm/)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/renfordt/icstorm/php)
![Packagist Downloads](https://img.shields.io/packagist/dt/renfordt/icstorm)
[![Code Climate coverage](https://img.shields.io/codeclimate/coverage/renfordt/ICStorm)](https://codeclimate.com/github/renfordt/ICStorm/test_coverage)
![php workflow](https://github.com/renfordt/ICStorm/actions/workflows/php.yml/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/255fa9a4fa63fb620150/maintainability)](https://codeclimate.com/github/renfordt/ICStorm/maintainability)

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
$icsFile = $calendar->generateICSFile();
```