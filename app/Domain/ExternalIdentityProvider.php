<?php

namespace App\Domain;

enum ExternalIdentityProvider: string
{
    case Vk = 'vk';
    case GitHub = 'github';
    case Google = 'google';
    case Yandex = 'yandex';
    case Twitter = 'twitter';
    case Facebook = 'facebook';

    public function externalLink(string $id): string
    {
        return match ($this) {
            self::Facebook => "https://www.facebook.com/{$id}",
            self::Google => "https://plus.google.com/{$id}",
            // self::Odnoklassniki => "https://ok.ru/profile/{$id}",
            self::Twitter => "https://twitter.com/intent/user?user_id={$id}",
            self::Vk => "https://vk.com/id{$id}",
            default => '#',
        };
    }
}
