<?php

namespace Tests\Feature;

use App\Domain\Locale;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MySettingsTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be(UserFactory::new()->create())
            ->get('my/settings')
            ->assertOk();
    }

    public function testUpdateLocale(): void
    {
        $user = UserFactory::new()->withLocale(Locale::Rus)->create();

        \Event::fake(\App\Events\Stats\MySettingsChanged::class);

        $this->be($user)
            ->put('my/settings', ['locale' => Locale::Eng->value])
            ->assertFound()
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertSame(Locale::Eng->value, $user->locale);

        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateTorrentShortTitle(): void
    {
        $user = UserFactory::new()->create();

        $this->assertSame(0, $user->magnet_short_title);

        \Event::fake(\App\Events\Stats\MySettingsChanged::class);

        $this->be($user)
            ->put('my/settings', ['magnet_short_title' => 1])
            ->assertFound()
            ->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertSame(1, $user->magnet_short_title);

        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }
}
