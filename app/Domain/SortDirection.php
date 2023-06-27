<?php

namespace App\Domain;

enum SortDirection: string
{
    case Asc = 'asc';
    case Desc = 'desc';
}
