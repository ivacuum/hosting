<?php

namespace Tests\Feature;

use App\Domain\ExternalIdentityProvider;
use App\Domain\SessionKey;
use App\Domain\UserStatus;
use App\Events\Stats\UserSignedInWithExternalIdentity;
use App\Factory\ExternalIdentityFactory;
use App\Factory\UserFactory;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Laravel\Socialite\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Tests\TestCase;

class SignInTest extends TestCase
{
    use DatabaseTransactions;

    public function testFacebookCallback()
    {
        Socialite::fake('facebook', SocialiteUser::fake([
            'id' => 'facebook-1',
            'email' => 'facebook@example.com',
        ]));

        $this->get('auth/facebook/callback')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user = User::query()->firstWhere(['email' => 'facebook@example.com']);
        $externalIdentity = $user->externalIdentities->first();

        $this->assertSame('facebook-1', $externalIdentity->uid);
        $this->assertSame(ExternalIdentityProvider::Facebook, $externalIdentity->provider);
    }

    public function testFacebookCallbackWithoutEmail()
    {
        Socialite::fake('facebook', SocialiteUser::fake([
            'id' => 'facebook-without-email',
            'email' => null,
        ]));

        $this->get('auth/facebook/callback')
            ->assertRedirect('auth/login')
            ->assertSessionHas(
                SessionKey::FlashMessage->value,
                static fn (HtmlString $message) => str_contains($message->toHtml(), 'auth/facebook?rerequest=1'),
            );

        $this->assertGuest();
        $this->assertDatabaseMissing('external_identities', [
            'provider' => ExternalIdentityProvider::Facebook,
            'uid' => 'facebook-without-email',
        ]);
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
        Socialite::fake('google', SocialiteUser::fake([
            'id' => 'google-1',
            'email' => 'google@example.com',
        ]));

        $this->get('auth/google/callback')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user = User::query()->firstWhere(['email' => 'google@example.com']);
        $externalIdentity = $user->externalIdentities->first();

        $this->assertSame('google-1', $externalIdentity->uid);
        $this->assertSame(ExternalIdentityProvider::Google, $externalIdentity->provider);
    }

    public function testGoogleCallbackActivatesAndLinksExistingUserByEmail()
    {
        $user = UserFactory::new()
            ->inactive()
            ->withEmail('existing@example.com')
            ->create();

        Socialite::fake('google', SocialiteUser::fake([
            'id' => 'google-existing-email',
            'email' => 'existing@example.com',
        ]));

        $this->get('auth/google/callback')
            ->assertRedirect('/');

        $user->refresh();

        $this->assertAuthenticatedAs($user);
        $this->assertSame(UserStatus::Active, $user->status);
        $this->assertDatabaseHas('external_identities', [
            'provider' => ExternalIdentityProvider::Google,
            'uid' => 'google-existing-email',
            'user_id' => $user->id,
        ]);
    }

    public function testGoogleCallbackAuthenticatesExistingLinkedIdentity()
    {
        \Event::fake(UserSignedInWithExternalIdentity::class);

        $user = UserFactory::new()->withEmail('linked@example.com')->create();

        ExternalIdentityFactory::new()
            ->google()
            ->withEmail('linked@example.com')
            ->withUid('google-linked')
            ->withUser($user)
            ->create();

        Socialite::fake('google', SocialiteUser::fake([
            'id' => 'google-linked',
            'email' => 'different-provider-email@example.com',
        ]));

        $this->get('auth/google/callback')
            ->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
        $this->assertSame(
            1,
            $user->externalIdentities()
                ->where('provider', ExternalIdentityProvider::Google)
                ->where('uid', 'google-linked')
                ->count(),
        );
        \Event::assertDispatched(UserSignedInWithExternalIdentity::class);
    }

    public function testGoogleCallbackHonorsIntendedUrl()
    {
        Socialite::fake('google', SocialiteUser::fake([
            'id' => 'google-intended',
            'email' => 'intended@example.com',
        ]));

        \Redirect::setIntendedUrl('/about');

        $this->get('auth/google/callback')
            ->assertRedirect('/about');

        $this->assertAuthenticated();
    }

    public function testGoogleCallbackWithoutEmail()
    {
        Socialite::fake('google', SocialiteUser::fake([
            'id' => 'google-without-email',
            'email' => null,
        ]));

        $this->get('auth/google/callback')
            ->assertRedirect('auth/login')
            ->assertSessionHas(
                SessionKey::FlashMessage->value,
                'Мы не можем вас зарегистрировать, так как не получили от Гугла вашу электронную почту',
            );

        $this->assertGuest();
        $this->assertDatabaseMissing('external_identities', [
            'provider' => ExternalIdentityProvider::Google,
            'uid' => 'google-without-email',
        ]);
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

    public function testSubmitGuestWithLegacyMd5Password()
    {
        $password = 'legacy_password';
        $user = UserFactory::new()->create();

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => md5($password),
                'salt' => '',
            ]);

        $this->from('auth/login')
            ->post('auth/login', [
                'email' => $user->email,
                'password' => $password,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user->refresh();
        $this->assertSame('', $user->salt);
        $this->assertNotSame(32, strlen($user->password));
        $this->assertTrue(password_verify($password, $user->password));
    }

    public function testSubmitGuestWithLegacySaltedMd5Password()
    {
        $password = 'legacy_salted';
        $salt = 'salt1';
        $user = UserFactory::new()->create();

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => md5($password . $salt),
                'salt' => $salt,
            ]);

        $this->from('auth/login')
            ->post('auth/login', [
                'email' => $user->email,
                'password' => $password,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user->refresh();
        $this->assertSame('', $user->salt);
        $this->assertNotSame(32, strlen($user->password));
        $this->assertTrue(password_verify($password, $user->password));
    }

    public function testVkCallback()
    {
        Socialite::fake('vk', SocialiteUser::fake([
            'id' => 'vk-1',
            'email' => 'vk@example.com',
        ]));

        $this->get('auth/vk/callback')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $user = User::query()->firstWhere(['email' => 'vk@example.com']);
        $externalIdentity = $user->externalIdentities->first();

        $this->assertSame('vk-1', $externalIdentity->uid);
        $this->assertSame(ExternalIdentityProvider::Vk, $externalIdentity->provider);
    }

    public function testVkCallbackWithoutEmail()
    {
        Socialite::fake('vk', SocialiteUser::fake([
            'id' => 'vk-without-email',
            'email' => null,
        ]));

        $this->get('auth/vk/callback')
            ->assertRedirect('auth/login')
            ->assertSessionHas(
                SessionKey::FlashMessage->value,
                static fn (HtmlString $message) => str_contains($message->toHtml(), 'auth/vk?revoke=1'),
            );

        $this->assertGuest();
        $this->assertDatabaseMissing('external_identities', [
            'provider' => ExternalIdentityProvider::Vk,
            'uid' => 'vk-without-email',
        ]);
    }

    public function testVkRedirect()
    {
        $this->get('auth/vk')
            ->assertRedirectContains('https://oauth.vk.com/authorize');

        $this->assertGuest();
    }
}
