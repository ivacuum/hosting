<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Сообщение в чате
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property string  $text
 * @property string  $html
 * @property string  $ip
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\User $user
 *
 * @mixin \Eloquent
 */
class ChatMessage extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $guarded = ['created_at', 'updated_at', 'goto'];

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
}
