<?php

namespace App;

use App\Domain\ChatMessageStatus;
use App\Observers\ChatMessageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
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
#[ObservedBy(ChatMessageObserver::class)]
class ChatMessage extends Model
{
    use Notifiable;

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'status' => ChatMessageStatus::class,
            'user_id' => 'int',
        ];
    }

    protected function text(): Attribute
    {
        return Attribute::make(
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
}
