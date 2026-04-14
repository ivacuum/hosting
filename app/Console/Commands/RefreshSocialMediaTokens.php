<?php

namespace App\Console\Commands;

use App\Domain\Instagram\InstagramApi;
use App\Domain\SocialMedia\Models\SocialMediaToken;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Database\Eloquent\Builder;

#[Signature('app:refresh-social-media-tokens {--user_id}')]
#[Description('Refresh expiring social media access tokens')]
class RefreshSocialMediaTokens extends Command implements Isolatable
{
    public function handle(InstagramApi $instagram)
    {
        $userId = $this->option('user_id');

        $query = SocialMediaToken::query()
            ->when($userId, static fn (Builder $query) => $query->where('user_id', $userId))
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
