<?php namespace App\Domain;

enum UserStatus: int
{
    case Inactive = 0;
    case Active = 1;
}
