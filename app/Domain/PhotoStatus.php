<?php namespace App\Domain;

enum PhotoStatus: int
{
    case Hidden = 0;
    case Published = 1;
}
