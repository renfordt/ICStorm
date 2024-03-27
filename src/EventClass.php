<?php

namespace renfordt\ICStorm;

enum EventClass: string
{
    case Public = 'PUBLIC';
    case Private = 'PRIVATE';
    case Confidential = 'CONFIDENTIAL';
}