<?php namespace App\Domain;

enum HangulWhatToTrain: int
{
    case AllTogether = 0;
    case Consonants = 1;
    case Vowels = 2;
}
