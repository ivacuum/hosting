<?php namespace App\Services\YandexPdd;

readonly class Account
{
    public function __construct(
        public string $login,
        public bool $enabled,
        public bool $ready,
        public string $fio,
        public array $aliases
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
