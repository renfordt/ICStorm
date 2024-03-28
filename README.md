<h1 align="center"> ICStorm</h1>

<div align="center">

<strong>A package for creating and importing iCalendar/ICS files with one or multiple events.</strong>

[![Badge](http://img.shields.io/badge/source-renfordt/ICStorm-blue.svg)](https://github.com/renfordt/ICStorm)
[![Packagist Version](https://img.shields.io/packagist/v/renfordt/icstorm?include_prereleases)](https://packagist.org/packages/renfordt/icstorm/)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/renfordt/icstorm/php)
![GitHub License](https://img.shields.io/github/license/renfordt/ICStorm)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/renfordt/ICStorm/php.yml?logo=github)
[![Code Climate coverage](https://img.shields.io/codeclimate/coverage/renfordt/ICStorm?logo=codeclimate)](https://codeclimate.com/github/renfordt/ICStorm/test_coverage)
[![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability/renfordt/ICStorm?logo=codeclimate)](https://codeclimate.com/github/renfordt/ICStorm/maintainability)
</div>

## Installation

The recommended way to install this package is using [Composer](https://getcomposer.org/). Execute the following
command. This will not only install
the package but also add it to your project's composer.json file as a dependency.

```
composer require renfordt/icstorm
```

## Usage

### Create Events

The PHP code below is used to create a new event.

The variables at the
beginning (`title`, `summary`, `description`, `startDate`, `endDate`, `classification`, `transparency`, and `location`)
represent different details of the event:

- `title`: The title of the event.
- `summary`: A brief overview of the event.
- `description`: Detailed information about the event.
- `startDate` and `endDate`: The start and end dates of the event and are mandatory.
- `classification`: The visibility of the event, indicating whether it's private or public.
- `transparency`: Indicates whether the time of the event is blocked or free.
- `location`: Location of the event.

These details are collected together into an associative array using the `compact` function. This array is then passed
as an argument to the `Event::createEvent` function, which generates an instance of an event with these details.

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
```

### Create an iCalendar

To create an iCalendar/ICS file you can use the following code.

First create a new Calendar instance and add all required Events to it. After that you can generate the ICS string or
the file with the functions.

```php
$calendar = new Calendar();
$calendar->addEvent($event);

$ics = $calendar->generateICS(); // generates a ICS string
$icsFile = $calendar->generateICSFile(); // generates a ICS file
```