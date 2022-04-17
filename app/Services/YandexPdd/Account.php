<?php namespace App\Services\YandexPdd;

class Account
{
    public function __construct(
        public readonly string $login,
        public readonly bool $enabled,
        public readonly bool $ready,
        public readonly string $fio,
        public readonly array $aliases
    ) {
    }

    public static function fromArray(array $payload)
    {
        return new self(
            $payload['login'],
            $payload['enabled'] === 'yes',
            $payload['ready'] === 'yes',
            $payload['fio'],
            $payload['aliases']
        );
    }
}
