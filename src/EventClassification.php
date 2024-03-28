<?php

namespace renfordt\ICStorm;

enum EventClassification: string
{
    case public = 'PUBLIC';
    case private = 'PRIVATE';
    case confidential = 'CONFIDENTIAL';
}
