<?php

namespace App\Console\Commands;

use App\Domain\Instagram\InstagramApi;
use App\Domain\SocialMedia\Models\SocialMediaToken;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:refresh-social-media-tokens')]
class RefreshSocialMediaTokens extends Command implements Isolatable
{
    protected $signature = 'app:refresh-social-media-tokens {--user_id}';

    public function handle(InstagramApi $instagram)
    {
        $userId = $this->option('user_id');

        $query = SocialMediaToken::query()
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->where('expired_at', '<', today()->addWeek());

        foreach ($query->lazy() as $token) {
            $response = $instagram->refreshAccessToken($token->token);

            $token->token = $response->accessToken;
            $token->created_at = now();
            $token->expired_at = now()->addSeconds($response->expiresIn);
            $token->save();
        }

        return self::SUCCESS;
    }
}
