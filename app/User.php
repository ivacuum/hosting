<?php namespace App;

use App\Http\Controllers\Users;
use App\Mail\ResetPasswordMail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;

/**
 * Пользователь
 *
 * @property int $id
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $salt
 * @property int $status
 * @property string $locale
 * @property int $theme
 * @property int $torrent_short_title
 * @property int $notify_gigs
 * @property int $notify_news
 * @property int $notify_trips
 * @property string $avatar
 * @property string $ip
 * @property string $activation_token
 * @property string $remember_token
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $last_login_at
 * @property \Carbon\CarbonImmutable $password_changed_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\ChatMessage[] $chatMessages
 * @property \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @property \Illuminate\Database\Eloquent\Collection|\App\ExternalIdentity[] $externalIdentities
 * @property \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property \Illuminate\Database\Eloquent\Collection|\App\News[] $news
 * @property \Illuminate\Database\Eloquent\Collection|\App\Notification[] $notifications
 * @property \Illuminate\Database\Eloquent\Collection|\App\Torrent[] $torrents
 * @property \Illuminate\Database\Eloquent\Collection|\App\Trip[] $trips
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const THEME_LIGHT = 0;
    const THEME_DARK = 1;

    const NOTIFY_NO = 0;
    const NOTIFY_MAIL = 1;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['password', 'salt', 'remember_token'];
    protected $dates = ['last_login_at', 'password_changed_at'];
    protected $perPage = 50;

    protected $casts = [
        'theme' => 'int',
        'status' => 'int',
        'notify_gigs' => 'int',
        'notify_news' => 'int',
        'notify_trips' => 'int',
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

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')
            ->orderByDesc('created_at');
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // Attributes
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = $value ? \Hash::make($value) : '';
    }

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function scopeForAnnouncement(Builder $query)
    {
        return $query->where('last_login_at', '>', now()->subDays(7));
    }

    // Methods
    public function activate(): bool
    {
        if ($this->status === static::STATUS_INACTIVE) {
            $this->status = static::STATUS_ACTIVE;
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
        return $this->avatar ? (new Avatar)->originalUrl($this->avatar) : '';
    }

    public function breadcrumb(): string
    {
        return $this->email ?? '';
    }

    public function displayName(): string
    {
        return $this->login ?: $this->email;
    }

    public static function findByEmailOrCreate(array $data): self
    {
        /** @var self $user */
        $user = self::where('email', $data['email'])->first();

        if (null !== $user) {
            return $user;
        }

        if (\Str::contains($data['email'], config('cfg.autoregister_suffixes_blacklist'))) {
            throw new \InvalidArgumentException('Данная электронная почта недоступна, укажите другую');
        }

        return self::registerAutomatically($data);
    }

    public function isAdmin(): bool
    {
        return $this->isRoot();
    }

    public function isOldPasswordCorrect($password): bool
    {
        if ($this->salt && md5($password . $this->salt) === $this->password) {
            return true;
        }

        if (!$this->salt && md5($password) === $this->password) {
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

    public function preferredLocale(): ?string
    {
        return $this->locale;
    }

    public function publicName(): string
    {
        return $this->login ?: "user #{$this->id}";
    }

    public static function registerAutomatically(array $data): self
    {
        event(new \App\Events\Stats\UserRegisteredAuto);

        return self::create($data);
    }

    public function sendPasswordResetNotification($token): void
    {
        \Mail::to($this)->send(new ResetPasswordMail($token));
    }

    public function uploadAvatar(UploadedFile $file): string
    {
        $avatar = new Avatar;

        $filename = $avatar->upload($file, $this->id);

        $this->avatar = $filename;
        $this->save();

        return $avatar->originalUrl($filename);
    }

    public function www(): string
    {
        return path([Users::class, 'show'], $this->id);
    }
}
