<?php

namespace App\Domain\Korean;

enum HangulWhatToTrain: int
{
    case AllTogether = 0;
    case Consonants = 1;
    case Vowels = 2;
}
