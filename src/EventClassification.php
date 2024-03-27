<?php

namespace renfordt\ICStorm;

enum EventClassification: string
{
    case Public = 'PUBLIC';
    case Private = 'PRIVATE';
    case Confidential = 'CONFIDENTIAL';
}