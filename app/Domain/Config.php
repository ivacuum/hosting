<?php

namespace App\Domain;

use Illuminate\Contracts\Support\Htmlable;

enum Config implements Htmlable
{
    case AirbnbLink;
    case AutoregisterSuffixesBlacklist;
    case BookingLink;
    case CommentFloodInterval;
    case CronOutput;
    case DigitalOceanLink;
    case DrimsimLink;
    case FirstVdsLink;
    case FirstVdsPromocode;
    case IssueFloodInterval;
    case Locale;
    case Locales;
    case MagnetAnonymousReleaser;
    case RtoProxy;
    case SiteName;
    case SupportEmail;
    case TelegramAdminId;
    case TelegramWebhookSecretToken;
    case TimewebLink;
    case VkAccessToken;

    public function get(): string|array|int|null
    {
        return match ($this) {
            self::AirbnbLink => config()->string('cfg.airbnb_link'),
            self::AutoregisterSuffixesBlacklist => config()->array('cfg.autoregister_suffixes_blacklist'),
            self::BookingLink => config()->string('cfg.booking_link'),
            self::CommentFloodInterval => config()->integer('cfg.limits.comment.flood_interval'),
            self::CronOutput => config()->string('cfg.cron_output'),
            self::DigitalOceanLink => config()->string('cfg.digitalocean_link'),
            self::DrimsimLink => config()->string('cfg.drimsim_link'),
            self::FirstVdsLink => config()->string('cfg.firstvds_link'),
            self::FirstVdsPromocode => config()->string('cfg.firstvds_promocode'),
            self::IssueFloodInterval => config()->integer('cfg.limits.issue.flood_interval'),
            self::Locale => config()->string('app.locale'),
            self::Locales => config()->array('cfg.locales'),
            self::MagnetAnonymousReleaser => config()->integer('cfg.magnet_anonymous_releaser'),
            self::RtoProxy => config('services.rto.proxy'),
            self::SiteName => config()->string('cfg.sitename'),
            self::SupportEmail => config()->string('email.support'),
            self::TelegramAdminId => config()->integer('services.telegram.admin_id'),
            self::TelegramWebhookSecretToken => config('services.telegram.webhook_secret_token'),
            self::TimewebLink => config()->string('cfg.timeweb_link'),
            self::VkAccessToken => config()->string('services.vk.access_token'),
        };
    }

    public function toHtml()
    {
        return e($this->get());
    }
}
