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

    public function canBeAdded(): bool
    {
        return match ($this) {
            self::NS,
            self::SOA => false,
            default => true,
        };
    }

    public function canHaveIdnContent(): bool
    {
        return match ($this) {
            self::A,
            self::AAAA,
            self::TXT => false,
            default => true,
        };
    }

    public function isCname(): bool
    {
        return $this === self::CNAME;
    }

    public function isSoa(): bool
    {
        return $this === self::SOA;
    }
}
