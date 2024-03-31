<?php

namespace renfordt\ICStorm;

enum EventClassificationEnum: string
{
    case public = 'PUBLIC';
    case private = 'PRIVATE';
    case confidential = 'CONFIDENTIAL';
}
