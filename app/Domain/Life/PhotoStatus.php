<?php

namespace App\Domain\Life;

enum PhotoStatus: int
{
    case Hidden = 0;
    case Published = 1;
}
