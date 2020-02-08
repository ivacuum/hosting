<?php namespace Tests\Feature;

use App\Factory\UserFactory;
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

        $this->be($user = UserFactory::new()->create());

        $this->expectsEvents(\App\Events\Stats\UserAvatarUploaded::class);

        $this->putJson('my/avatar', ['file' => $file])
            ->assertStatus(200)
            ->assertJson(['status' => 'OK']);

        $user->refresh();

        $this->assertNotEmpty($user->avatar);

        \Storage::disk('avatars')->assertExists($user->avatar);

        $lastAvatar = $user->avatar;

        $file = UploadedFile::fake()->image('new-avatar.jpg');

        $this->putJson('my/avatar', ['file' => $file])
            ->assertStatus(200)
            ->assertJson(['status' => 'OK']);

        $user->refresh();

        $this->assertNotEmpty($user->avatar);
        $this->assertNotEquals($lastAvatar, $user->avatar);

        \Storage::disk('avatars')->assertMissing($lastAvatar);
        \Storage::disk('avatars')->assertExists($user->avatar);
    }

    public function testUserDeletesHisAvatar()
    {
        \Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->be($user = UserFactory::new()->create());

        $this->expectsEvents(\App\Events\Stats\UserAvatarUploaded::class);

        $this->putJson('my/avatar', ['file' => $file])
            ->assertStatus(200)
            ->assertJson(['status' => 'OK']);

        $user->refresh();

        $avatar = $user->avatar;

        $this->assertNotEmpty($avatar);

        \Storage::disk('avatars')->assertExists($avatar);

        $this->deleteJson('my/avatar')
            ->assertNoContent();

        $user->refresh();

        $this->assertEmpty($user->avatar);

        \Storage::disk('avatars')->assertMissing($avatar);
    }
}
