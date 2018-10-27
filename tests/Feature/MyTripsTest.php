<?php namespace Tests\Feature;

use App\Trip;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyTripsTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->be($user = factory(User::class)->make());

        $this->get(action('MyTrips@create'))
            ->assertStatus(200);
    }

    public function testDestroy()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        /** @var Trip $trip */
        $trip = factory(Trip::class)->create(['user_id' => $user->id]);

        $this->delete(action('MyTrips@destroy', $trip))
            ->assertRedirect(action('MyTrips@index'));

        $this->assertDatabaseMissing($trip->getTable(), ['id' => $trip->id]);
    }

    public function testEdit()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        /** @var Trip $trip */
        $trip = factory(Trip::class)->create(['user_id' => $user->id]);

        $this->get(action('MyTrips@edit', $trip))
            ->assertStatus(200);
    }

    public function testIndex()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        factory(Trip::class)->create(['user_id' => $user->id]);

        $this->get(action('MyTrips@index'))
            ->assertStatus(200);
    }

    public function testStore()
    {
        /* @var User $user */
        $user = factory(User::class)->create();

        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->make();

        $this->be($user)
            ->post(action('MyTrips@store', $trip), $trip->attributesToArray())
            ->assertRedirect(action('MyTrips@index'));

        $trip_saved = Trip::where('city_id', $trip->city_id)->first();

        $this->assertEquals($trip->city->title_en, $trip_saved->title_en);
        $this->assertEquals($trip->city->title_ru, $trip_saved->title_ru);
    }

    public function testUpdate()
    {
        /* @var User $user */
        $user = factory(User::class)->create();

        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->create(['user_id' => $user->id]);

        $data = [
            'slug' => '_new-slug_',
            'title_en' => 'title EN',
            'title_ru' => 'title RU',
            'date_end' => '2018-12-31',
            'markdown' => 'some formatted *markdown*',
            'date_start' => '2018-01-01',
        ];

        $this->be($user)
            ->put(action('MyTrips@update', $trip), array_merge($trip->attributesToArray(), $data))
            ->assertRedirect(action('MyTrips@index'));

        $trip->refresh();

        $this->assertEquals($data['slug'], $trip->slug);
        $this->assertEquals($data['title_en'], $trip->title_en);
        $this->assertEquals($data['title_ru'], $trip->title_ru);
        $this->assertEquals($data['date_end'], $trip->date_end->toDateString());
        $this->assertEquals($data['date_start'], $trip->date_start->toDateString());
        $this->assertEquals($data['markdown'], $trip->markdown);
    }
}
