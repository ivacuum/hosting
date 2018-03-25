<?php namespace App;

use App\Mail\ResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;

/**
 * Пользователь
 *
 * @property integer $id
 * @property string  $email
 * @property string  $login
 * @property string  $password
 * @property string  $salt
 * @property integer $status
 * @property integer $theme
 * @property integer $torrent_short_title
 * @property string  $avatar
 * @property string  $ip
 * @property string  $activation_token
 * @property string  $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $last_login_at
 * @property \Illuminate\Support\Carbon $password_changed_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $chatMessages
 * @property \Illuminate\Database\Eloquent\Collection $comments
 * @property \Illuminate\Database\Eloquent\Collection $externalIdentities
 * @property \Illuminate\Database\Eloquent\Collection $images
 * @property \Illuminate\Database\Eloquent\Collection $news
 * @property \Illuminate\Database\Eloquent\Collection $torrents
 * @property \Illuminate\Database\Eloquent\Collection $trips
 * @property \Illuminate\Database\Eloquent\Collection $notifications
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const THEME_LIGHT = 0;
    const THEME_DARK = 1;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['last_login_at'];
    protected $perPage = 50;

    // Relations
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // Attributes
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
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
        return $this->email;
    }

    public function displayName(): string
    {
        return $this->login ?: $this->email;
    }

    public function findByEmailOrCreate(array $data): self
    {
        $user = $this->where('email', $data['email'])->first();

        if (!is_null($user)) {
            return $user;
        }

        if (str_contains($data['email'], config('cfg.autoregister_suffixes_blacklist'))) {
            throw new \InvalidArgumentException('Данная электронная почта недоступна, укажите другую');
        }

        return $this->registerAutomatically($data);
    }

    public function isAdmin(): bool
    {
        return $this->isRoot();
    }

    public function isOldPasswordCorrect($password): bool
    {
        if ($this->salt && md5($password.$this->salt) === $this->password) {
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
        $have_unread = false;

        foreach ($this->notifications as $notification) {
            if ($notification->unread()) {
                $have_unread = true;
                break;
            }
        }

        if ($have_unread) {
            $affected_rows = $this->unreadNotifications()->update(['read_at' => now()]);

            for ($i = 0; $i < $affected_rows; $i++) {
                event(new \App\Events\Stats\NotificationRead);
            }
        }

        return $have_unread;
    }

    public function publicName(): string
    {
        return $this->login ?: "user #{$this->id}";
    }

    public function registerAutomatically(array $data): self
    {
        event(new \App\Events\Stats\UserRegisteredAuto);

        return $this->create($data);
    }

    public function sendPasswordResetNotification($token): void
    {
        \Mail::to($this)->queue(new ResetPassword($token));
    }

    public function uploadAvatar(UploadedFile $file): string
    {
        $avatar = new Avatar;

        if ($this->avatar) {
            $avatar->delete($this->avatar);
        }

        $filename = $avatar->upload($file, $this->id);

        $this->avatar = $filename;
        $this->save();

        return $avatar->originalUrl($filename);
    }

    public function www(): string
    {
        return path('Users@show', $this->id);
    }
}
