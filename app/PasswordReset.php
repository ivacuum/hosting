<?php namespace App;

use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property \Carbon\CarbonImmutable $created_at
 *
 * @mixin \Eloquent
 */
class PasswordReset extends Model
{
    use MassPrunable;

    public function prunable()
    {
        return self::query()
            ->where('created_at', '<', now()->subMinutes(config('auth.passwords.users.expire')));
    }
}
