<?php

namespace App\Domain;

enum RtoTopicStatus: int
{
    case NotModerated = 0;
    case Closed = 1;
    case Approved = 2;
    case AlmostFormatted = 3;
    case NotFormatted = 4;
    case Duplicate = 5;
    case Absorbed = 7;
    case Questionable = 8;
    case InModeration = 9;
    case Temporary = 10;
    case Premoderation = 11;

    public function isDuplicate(): bool
    {
        return $this === self::Duplicate;
    }

    public function isPremoderation(): bool
    {
        return $this === self::Premoderation;
    }
}
