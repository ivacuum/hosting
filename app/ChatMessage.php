<?php namespace App;

use App\Domain\ChatMessageStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property int $user_id
 * @property ChatMessageStatus $status
 * @property string $text
 * @property string $html
 * @property string $ip
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property User $user
 *
 * @mixin \Eloquent
 */
class ChatMessage extends Model
{
    protected $casts = [
        'status' => ChatMessageStatus::class,
        'user_id' => 'int',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Attributes
    public function text(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                $converter = new CommonMarkConverter([
                    'html_input' => 'escape',
                    'max_nesting_level' => 15,
                    'allow_unsafe_links' => false,
                ]);

                return [
                    'text' => htmlspecialchars($value),
                    'html' => $converter->convert($value)->getContent(),
                ];
            }
        );
    }

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }
}
