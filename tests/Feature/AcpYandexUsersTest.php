<?php

namespace Tests\Feature;

use App\Factory\YandexUserFactory;
use App\Http\Livewire\Acp\YandexUserForm;
use App\YandexUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpYandexUsersTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/yandex-users/create')
            ->assertOk()
            ->assertSeeLivewire(YandexUserForm::class);
    }

    public function testEdit()
    {
        $yandexUser = YandexUserFactory::new()->create();

        $this->get("acp/yandex-users/{$yandexUser->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(YandexUserForm::class);
    }

    public function testIndex()
    {
        YandexUserFactory::new()->create();

        $this->get('acp/yandex-users')
            ->assertOk();
    }

    public function testShow()
    {
        $yandexUser = YandexUserFactory::new()->create();

        $this->get("acp/yandex-users/{$yandexUser->id}")
            ->assertOk();
    }

    public function testStore()
    {
        \Livewire::test(YandexUserForm::class, ['yandexUser' => new YandexUser])
            ->set('token', 'little-secret')
            ->set('yandexUser.account', 'phpunit-account')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/yandex-users');

        $this->get('acp/yandex-users')
            ->assertSee('phpunit-account');
    }

    public function testUpdate()
    {
        $yandexUser = YandexUserFactory::new()->create();

        \Livewire::test(YandexUserForm::class, ['yandexUser' => $yandexUser])
            ->set('yandexUser.account', 'Sparks ✨')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/yandex-users');

        $yandexUser->refresh();

        $this->assertSame('Sparks ✨', $yandexUser->account);
    }
}
