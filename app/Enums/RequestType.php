<?php

namespace App\Enums;

enum RequestType: int
{
    case Pending = 1;
    case Answered = 2;
}
