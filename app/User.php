<?php

namespace App;

use App\Domain\Magnet\Models\Magnet;
use App\Domain\NotificationDeliveryMethod;
use App\Domain\SocialMedia\Models\SocialMediaToken;
use App\Domain\UserStatus;
use App\Observers\UserObserver;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $salt
 * @property int $status
 * @property string $locale
 * @property int $magnet_short_title
 * @property NotificationDeliveryMethod $notify_gigs
 * @property NotificationDeliveryMethod $notify_news
 * @property NotificationDeliveryMethod $notify_trips
 * @property NotificationDeliveryMethod $notification_delivery_method
 * @property string $avatar
 * @property int $telegram_id
 * @property string $ip
 * @property string $activation_token
 * @property string $remember_token
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $last_login_at
 * @property \Carbon\CarbonImmutable $password_changed_at
 * @property \Carbon\CarbonImmutable $email_verified_at
 * @property \Carbon\CarbonImmutable $telegram_linked_at
 * @property \Illuminate\Database\Eloquent\Collection<int, ChatMessage> $chatMessages
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property \Illuminate\Database\Eloquent\Collection<int, Email> $emails
 * @property \Illuminate\Database\Eloquent\Collection<int, ExternalIdentity> $externalIdentities
 * @property \Illuminate\Database\Eloquent\Collection<int, Image> $images
 * @property \Illuminate\Database\Eloquent\Collection<int, Magnet> $magnets
 * @property \Illuminate\Database\Eloquent\Collection<int, News> $news
 * @property \Illuminate\Database\Eloquent\Collection<int, SocialMediaToken> $socialMediaTokens
 * @property \Illuminate\Database\Eloquent\Collection<int, Trip> $trips
 * @property-read int $chat_messages_count
 * @property-read int $comments_count
 * @property-read int $emails_count
 * @property-read int $images_count
 * @property-read int $issues_count
 * @property-read int $magnets_count
 * @property-read int $trips_count
 *
 * @mixin \Eloquent
 */
#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable;

    public const int STATUS_INACTIVE = 0;
    public const int STATUS_ACTIVE = 1;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['password', 'salt', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'];

    protected $attributes = [
        'avatar' => '',
        'remember_token' => null,
        'notify_gigs' => NotificationDeliveryMethod::Disabled,
        'notify_news' => NotificationDeliveryMethod::Disabled,
        'notify_trips' => NotificationDeliveryMethod::Disabled,
        'notification_delivery_method' => NotificationDeliveryMethod::Disabled,
    ];

    // Relations
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class)->chaperone();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->chaperone();
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'rel')->chaperone();
    }

    public function externalIdentities()
    {
        return $this->hasMany(ExternalIdentity::class)->chaperone();
    }

    public function images()
    {
        return $this->hasMany(Image::class)->chaperone();
    }

    public function issues()
    {
        return $this->hasMany(Issue::class)->chaperone();
    }

    public function magnets()
    {
        return $this->hasMany(Magnet::class)->chaperone();
    }

    public function news()
    {
        return $this->hasMany(News::class)->chaperone();
    }

    public function socialMediaTokens()
    {
        return $this->hasMany(SocialMediaToken::class)->chaperone();
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)->chaperone();
    }

    // Methods
    public function activate(): bool
    {
        if ($this->status === UserStatus::Inactive->value) {
            $this->status = UserStatus::Active->value;
            $this->activation_token = '';
            $this->save();

            return true;
        }

        return false;
    }

    public function avatarName(): string
    {
        return mb_strtoupper(mb_substr($this->login ?: $this->email, 0, 1));
    }

    public function avatarUrl(): string
    {
        return $this->avatar ? (new Avatar)->url($this->avatar) : '';
    }

    public function breadcrumb(): string
    {
        return $this->email ?? '';
    }

    public function displayName(): string
    {
        return $this->login ?: $this->email;
    }

    public function isActive(): bool
    {
        return $this->status === UserStatus::Active->value;
    }

    public function isAdmin(): bool
    {
        return $this->isRoot();
    }

    public function isOldPasswordCorrect(#[\SensitiveParameter] $password): bool
    {
        if ($this->salt && $this->password === md5($password . $this->salt)) {
            return true;
        }

        if (!$this->salt && $this->password === md5($password)) {
            return true;
        }

        return false;
    }

    public function isPasswordOld(): bool
    {
        return strlen($this->password) === 32;
    }

    public function isRoot(): bool
    {
        return $this->id === 1;
    }

    #[\Override]
    public function preferredLocale(): string|null
    {
        return $this->locale;
    }

    public function publicName(): string
    {
        return $this->login ?: "user #{$this->id}";
    }

    #[\Override]
    public function sendPasswordResetNotification(#[\SensitiveParameter] $token): void
    {
        \Mail::to($this)->send(new Mail\ResetPasswordMail($token));
    }

    public function uploadAvatar(UploadedFile $file): string
    {
        $avatar = new Avatar;

        $filename = $avatar->upload($file, $this->id);

        $this->avatar = $filename;
        $this->save();

        return $avatar->url($filename);
    }

    public function www(): string
    {
        return to('users/{user}', $this->id);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'status' => 'int',
            'notify_gigs' => NotificationDeliveryMethod::class,
            'notify_news' => NotificationDeliveryMethod::class,
            'notify_trips' => NotificationDeliveryMethod::class,
            'last_login_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'magnet_short_title' => 'int',
            'telegram_linked_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'notification_delivery_method' => NotificationDeliveryMethod::class,
        ];
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value
                ? \Hash::make($value)
                : '',
        );
    }
}
