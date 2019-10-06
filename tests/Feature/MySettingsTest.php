<?php namespace Tests\Feature;

use App;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MySettingsTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be(factory(User::class)->create())
            ->get(action('MySettings@edit'))
            ->assertStatus(200);
    }

    /**
     * @dataProvider dataToChange
     * @param mixed $old
     * @param mixed $new
     * @param string $field
     * @param array $events
     */
    public function testUpdate($old, $new, string $field, array $events)
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create([$field => $old]));

        $this->expectsEvents($events);

        $this->put(action('MySettings@update'), [$field => $new])
            ->assertStatus(302);

        $user->refresh();

        $this->assertEquals($new, $user->{$field});
    }

    public function dataToChange()
    {
        return [
            'Switch theme' => [
                'old' => User::THEME_LIGHT,
                'new' => User::THEME_DARK,
                'field' => 'theme',
                'events' => [
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Change locale' => [
                'old' => 'ru',
                'new' => 'en',
                'field' => 'locale',
                'events' => [
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Subscribe to gig notifications' => [
                'old' => 0,
                'new' => 1,
                'field' => 'notify_gigs',
                'events' => [
                    App\Events\Stats\GigsSubscribed::class,
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Unsubscribe from gigs notifications' => [
                'old' => 1,
                'new' => 0,
                'field' => 'notify_gigs',
                'events' => [
                    App\Events\Stats\GigsUnsubscribed::class,
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Subscribe to news notifications' => [
                'old' => 0,
                'new' => 1,
                'field' => 'notify_news',
                'events' => [
                    App\Events\Stats\NewsSubscribed::class,
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Unsubscribe from news notifications' => [
                'old' => 1,
                'new' => 0,
                'field' => 'notify_news',
                'events' => [
                    App\Events\Stats\NewsUnsubscribed::class,
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Subscribe to trip notifications' => [
                'old' => 0,
                'new' => 1,
                'field' => 'notify_trips',
                'events' => [
                    App\Events\Stats\TripsSubscribed::class,
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Unsubscribe from trip notifications' => [
                'old' => 1,
                'new' => 0,
                'field' => 'notify_trips',
                'events' => [
                    App\Events\Stats\TripsUnsubscribed::class,
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
            'Shorten release titles' => [
                'old' => 0,
                'new' => 1,
                'field' => 'torrent_short_title',
                'events' => [
                    App\Events\Stats\MySettingsChanged::class,
                ],
            ],
        ];
    }
}
