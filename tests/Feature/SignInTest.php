<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SignInTest extends TestCase
{
    use DatabaseTransactions;

    public function testFacebookCallback()
    {
        $socialUser = $this->mock('Laravel\Socialite\Two\User');
        $socialUser->shouldReceive('getId')->atLeast()->once()->andReturn('1');
        $socialUser->shouldReceive('getEmail')->atLeast()->once()->andReturn('facebook@example.com');

        \Socialite::expects('driver->user')->andReturn($socialUser);

        $this->get('auth/facebook/callback')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user = User::query()->firstWhere(['email' => 'facebook@example.com']);
        $externalIdentity = $user->externalIdentities->first();

        $this->assertSame('1', $externalIdentity->uid);
        $this->assertSame('facebook', $externalIdentity->provider);
    }

    public function testFacebookRedirect()
    {
        $this->get('auth/facebook')
            ->assertRedirectContains('https://www.facebook.com/v23.0/dialog/oauth');

        $this->assertGuest();
    }

    public function testFormGuest()
    {
        $this->get('auth/login')
            ->assertOk();

        $this->assertGuest();
    }

    public function testFormUser()
    {
        $this->be(UserFactory::new()->make())
            ->get('auth/login')
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testGoogleCallback()
    {
        $socialUser = $this->mock('Laravel\Socialite\Two\User');
        $socialUser->shouldReceive('getId')->atLeast()->once()->andReturn('1');
        $socialUser->shouldReceive('getEmail')->atLeast()->once()->andReturn('google@example.com');

        \Socialite::expects('driver->user')->andReturn($socialUser);

        $this->get('auth/google/callback')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user = User::query()->firstWhere(['email' => 'google@example.com']);
        $externalIdentity = $user->externalIdentities->first();

        $this->assertSame('1', $externalIdentity->uid);
        $this->assertSame('google', $externalIdentity->provider);
    }

    public function testGoogleRedirect()
    {
        $this->get('auth/google')
            ->assertRedirectContains('https://accounts.google.com/o/oauth2/auth');

        $this->assertGuest();
    }

    public function testSubmitGuest()
    {
        $user = UserFactory::new()->withPassword('secret42')->create();

        $this->from('auth/login')
            ->post('auth/login', [
                'email' => $user->email,
                'password' => 'secret42',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testVkCallback()
    {
        $socialUser = $this->mock('Laravel\Socialite\Two\User');
        $socialUser->shouldReceive('getId')->atLeast()->once()->andReturn('1');
        $socialUser->shouldReceive('getEmail')->atLeast()->once()->andReturn('vk@example.com');

        \Socialite::expects('driver->user')->andReturn($socialUser);

        $this->get('auth/vk/callback')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user = User::query()->firstWhere(['email' => 'vk@example.com']);
        $externalIdentity = $user->externalIdentities->first();

        $this->assertSame('1', $externalIdentity->uid);
        $this->assertSame('vk', $externalIdentity->provider);
    }

    public function testVkRedirect()
    {
        $this->get('auth/vk')
            ->assertRedirectContains('https://oauth.vk.com/authorize');

        $this->assertGuest();
    }
}
