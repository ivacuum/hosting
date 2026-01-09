<?php

namespace App;

use App\Http\Controllers\MailController;
use App\Observers\EmailObserver;
use App\Policies\EmailPolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $rel_type
 * @property int $rel_id
 * @property string $to
 * @property string $template
 * @property string $locale
 * @property int $clicks
 * @property int $views
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
#[ObservedBy(EmailObserver::class)]
#[UsePolicy(EmailPolicy::class)]
class Email extends Model
{
    const TIMESTAMP_FORMAT = 'YmdHis';

    protected $guarded = ['created_at'];
    protected $perPage = 50;

    protected $casts = [
        'user_id' => 'int',
    ];

    // Relations
    public function rel()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return "Письмо #{$this->id}";
    }

    public function getTimestamp(): string
    {
        return $this->created_at->format(static::TIMESTAMP_FORMAT);
    }

    public function hasValidTimestamp(string $timestamp): bool
    {
        return $timestamp === $this->getTimestamp();
    }

    public function incrementClicks()
    {
        $this->increment('clicks');
    }

    public function reportLink(): string
    {
        return path([MailController::class, 'report'], [
            $this->getTimestamp(),
            $this->id,
        ]);
    }

    public function signedLink(string $goto, $expiration = null): string
    {
        return \URL::signedRoute('mail.click', [
            'id' => $this->id,
            'goto' => $goto,
            'timestamp' => $this->getTimestamp(),
        ], $expiration);
    }
}
