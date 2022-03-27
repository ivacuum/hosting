<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $text
 * @property string $html
 * @property string $ip
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property User $user
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
        $this->attributes['text'] = htmlspecialchars($value);

        $converter = new CommonMarkConverter([
            'html_input' => 'escape',
            'max_nesting_level' => 15,
            'allow_unsafe_links' => false,
        ]);

        $this->attributes['html'] = $converter->convert($value)->getContent();
    }

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    public function isHidden(): bool
    {
        return $this->status === self::STATUS_HIDDEN;
    }

    public function wwwAcp(): string
    {
        return path([Http\Controllers\Acp\ChatMessages::class, 'show'], $this);
    }

    public function wwwAcpUser(): string
    {
        return path([Http\Controllers\Acp\Users::class, 'show'], $this->user_id);
    }
}
