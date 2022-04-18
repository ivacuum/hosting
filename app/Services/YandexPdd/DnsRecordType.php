<?php namespace App\Services\YandexPdd;

enum DnsRecordType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case CNAME = 'CNAME';
    case MX = 'MX';
    case NS = 'NS';
    case SOA = 'SOA';
    case SRV = 'SRV';
    case TXT = 'TXT';
}
