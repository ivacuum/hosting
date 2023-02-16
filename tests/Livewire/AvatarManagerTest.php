<?php namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Http\Livewire\AvatarManager;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AvatarManagerTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserUploadsFirstAvatarAndThenReplacesIt()
    {
        \Storage::fake('avatars');
        \Storage::fake('tmp-for-tests');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $user = UserFactory::new()->create();

        \Event::fake(\App\Events\Stats\UserAvatarUploaded::class);

        $livewire = \Livewire::actingAs($user)
            ->test(AvatarManager::class)
            ->set('image', $file);

        $user->refresh();

        $this->assertNotEmpty($user->avatar);

        \Storage::disk('avatars')->assertExists($user->avatar);

        $lastAvatar = $user->avatar;

        $file = UploadedFile::fake()->image('new-avatar.jpg');

        $livewire->set('image', $file);

        $user->refresh();

        $this->assertNotEmpty($user->avatar);
        $this->assertNotEquals($lastAvatar, $user->avatar);

        \Event::assertDispatched(\App\Events\Stats\UserAvatarUploaded::class);
        \Storage::disk('avatars')->assertMissing($lastAvatar);
        \Storage::disk('avatars')->assertExists($user->avatar);
    }

    public function testUserDeletesHisAvatar()
    {
        \Storage::fake('avatars');
        \Storage::fake('tmp-for-tests');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $user = UserFactory::new()->create();

        \Event::fake(\App\Events\Stats\UserAvatarUploaded::class);

        $livewire = \Livewire::actingAs($user)
            ->test(AvatarManager::class)
            ->set('image', $file);

        $user->refresh();

        $avatar = $user->avatar;

        $this->assertNotEmpty($avatar);

        \Storage::disk('avatars')->assertExists($avatar);

        $livewire->call('deleteAvatar');

        $user->refresh();

        $this->assertEmpty($user->avatar);

        \Event::assertDispatched(\App\Events\Stats\UserAvatarUploaded::class);
        \Storage::disk('avatars')->assertMissing($avatar);
    }
}
