<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Сообщение в чате
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $text
 * @property string $html
 * @property string $ip
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class ChatMessage extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['html', 'created_at', 'updated_at', 'goto'];

    protected $casts = [
        'status' => 'int',
        'user_id' => 'int',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Attributes
    public function setTextAttribute($value)
    {
        $this->attributes['text'] = $this->attributes['html'] = htmlspecialchars($value);

        // Можно включить после добавления в Parsedown безопасного режима
        /*
        $this->attributes['html'] = \Parsedown::instance()
            ->setMarkupEscaped(true)
            ->text($value);
        */
    }

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }
}
