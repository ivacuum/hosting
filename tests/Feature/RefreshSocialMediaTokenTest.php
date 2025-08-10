<?php

namespace Tests\Feature;

use App\Console\Commands\RefreshSocialMediaTokens;
use App\Domain\Instagram\InstagramRefreshAccessTokenResponse;
use App\Domain\SocialMedia\Factory\SocialMediaTokenFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RefreshSocialMediaTokenTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        \Http::fake([
            ...InstagramRefreshAccessTokenResponse::fakeSuccess('new_token'),
        ]);

        $user = UserFactory::new()->create();

        $token = SocialMediaTokenFactory::new()
            ->withExpiresAt(today()->addDay())
            ->withUserId($user->id)
            ->create();

        $this
            ->artisan(RefreshSocialMediaTokens::class, ['--user_id' => $user->id])
            ->assertSuccessful();

        $token->refresh();

        $this->assertSame('new_token', $token->token);
    }
}
