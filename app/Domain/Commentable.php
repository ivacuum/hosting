<?php namespace App\Domain;

enum Commentable: string
{
    case News = 'news';
    case Trip = 'trip';
    case Magnet = 'magnet';
}
