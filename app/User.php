<?php

namespace App;

use App\Domain\NotificationDeliveryMethod;
use App\Domain\UserStatus;
use Illuminate\Contracts\Translation\HasLocalePreference;
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
 * @property int $torrent_short_title
 * @property NotificationDeliveryMethod $notify_gigs
 * @property NotificationDeliveryMethod $notify_news
 * @property NotificationDeliveryMethod $notify_trips
 * @property string $avatar
 * @property int $telegram_id
 * @property string $ip
 * @property string $activation_token
 * @property string $remember_token
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $last_login_at
 * @property \Carbon\CarbonImmutable $password_changed_at
 * @property \Illuminate\Database\Eloquent\Collection|ChatMessage[] $chatMessages
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property \Illuminate\Database\Eloquent\Collection|Email[] $emails
 * @property \Illuminate\Database\Eloquent\Collection|ExternalIdentity[] $externalIdentities
 * @property \Illuminate\Database\Eloquent\Collection|Image[] $images
 * @property \Illuminate\Database\Eloquent\Collection|Magnet[] $magnets
 * @property \Illuminate\Database\Eloquent\Collection|News[] $news
 * @property \Illuminate\Database\Eloquent\Collection|Notification[] $notifications
 * @property \Illuminate\Database\Eloquent\Collection|Trip[] $trips
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
class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable;

    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['password', 'salt', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'];
    protected $perPage = 50;

    protected $attributes = [
        'avatar' => '',
        'remember_token' => null,
    ];

    protected $casts = [
        'status' => 'int',
        'notify_gigs' => NotificationDeliveryMethod::class,
        'notify_news' => NotificationDeliveryMethod::class,
        'notify_trips' => NotificationDeliveryMethod::class,
        'last_login_at' => 'datetime',
        'password_changed_at' => 'datetime',
        'torrent_short_title' => 'int',
    ];

    // Relations
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'rel');
    }

    public function externalIdentities()
    {
        return $this->hasMany(ExternalIdentity::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function magnets()
    {
        return $this->hasMany(Magnet::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')
            ->orderByDesc('created_at');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
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

    public function isOldPasswordCorrect($password): bool
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

    public function markNotificationsAsRead(): bool
    {
        $hasUnread = false;

        foreach ($this->notifications as $notification) {
            if ($notification->unread()) {
                $hasUnread = true;
                break;
            }
        }

        if ($hasUnread) {
            $affectedRows = $this->unreadNotifications()->update(['read_at' => now()]);

            for ($i = 0; $i < $affectedRows; $i++) {
                event(new \App\Events\Stats\NotificationRead);
            }
        }

        return $hasUnread;
    }

    public function preferredLocale(): string|null
    {
        return $this->locale;
    }

    public function publicName(): string
    {
        return $this->login ?: "user #{$this->id}";
    }

    public function sendPasswordResetNotification($token): void
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

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value
                ? \Hash::make($value)
                : '',
        );
    }
}
