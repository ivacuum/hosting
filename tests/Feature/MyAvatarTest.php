<?php namespace Tests\Feature;

use App;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MyAvatarTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserUploadsFirstAvatarAndThenReplacesIt()
    {
        \Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        /* @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents(App\Events\Stats\UserAvatarUploaded::class);

        $this->putJson(action('MyAvatar@update'), compact('file'))
            ->assertStatus(200)
            ->assertJson(['status' => 'OK']);

        $user->refresh();

        $this->assertNotEmpty($user->avatar);

        \Storage::disk('avatars')->assertExists($user->avatar);

        $last_avatar = $user->avatar;

        $file = UploadedFile::fake()->image('new-avatar.jpg');

        $this->putJson(action('MyAvatar@update'), compact('file'))
            ->assertStatus(200)
            ->assertJson(['status' => 'OK']);

        $user->refresh();

        $this->assertNotEmpty($user->avatar);
        $this->assertNotEquals($last_avatar, $user->avatar);

        \Storage::disk('avatars')->assertMissing($last_avatar);
        \Storage::disk('avatars')->assertExists($user->avatar);
    }

    public function testUserDeletesHisAvatar()
    {
        \Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        /* @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents(App\Events\Stats\UserAvatarUploaded::class);

        $this->putJson(action('MyAvatar@update'), compact('file'))
            ->assertStatus(200)
            ->assertJson(['status' => 'OK']);

        $user->refresh();

        $avatar = $user->avatar;

        $this->assertNotEmpty($avatar);

        \Storage::disk('avatars')->assertExists($avatar);

        $this->deleteJson(action('MyAvatar@destroy'))
            ->assertStatus(204);

        $user->refresh();

        $this->assertEmpty($user->avatar);

        \Storage::disk('avatars')->assertMissing($avatar);
    }
}
