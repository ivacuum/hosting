<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Trip;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyTripsTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->be(UserFactory::new()->withId(1)->make())
            ->get('my/trips/create')
            ->assertStatus(200);
    }

    public function testDestroy()
    {
        $this->be($user = UserFactory::new()->create());

        /** @var Trip $trip */
        $trip = factory(Trip::class)->create(['user_id' => $user->id]);

        $this->delete("my/trips/{$trip->id}")
            ->assertRedirect('my/trips');

        $this->assertDatabaseMissing($trip->getTable(), ['id' => $trip->id]);
    }

    public function testEdit()
    {
        $this->be($user = UserFactory::new()->create());

        /** @var Trip $trip */
        $trip = factory(Trip::class)->create(['user_id' => $user->id]);

        $this->get("my/trips/{$trip->id}/edit")
            ->assertStatus(200);
    }

    public function testIndex()
    {
        $this->be($user = UserFactory::new()->create());

        factory(Trip::class)->create(['user_id' => $user->id]);

        $this->get('my/trips')
            ->assertStatus(200);
    }

    public function testStore()
    {
        $user = UserFactory::new()->create();

        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->make();

        $this->be($user)
            ->post('my/trips', $trip->attributesToArray())
            ->assertRedirect('my/trips');

        $tripSaved = Trip::where('city_id', $trip->city_id)->first();

        $this->assertEquals($trip->city->title_en, $tripSaved->title_en);
        $this->assertEquals($trip->city->title_ru, $tripSaved->title_ru);
    }

    public function testUpdate()
    {
        $user = UserFactory::new()->create();

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
            ->put("my/trips/{$trip->id}", array_merge($trip->attributesToArray(), $data))
            ->assertRedirect('my/trips');

        $trip->refresh();

        $this->assertEquals($data['slug'], $trip->slug);
        $this->assertEquals($data['title_en'], $trip->title_en);
        $this->assertEquals($data['title_ru'], $trip->title_ru);
        $this->assertEquals($data['date_end'], $trip->date_end->toDateString());
        $this->assertEquals($data['date_start'], $trip->date_start->toDateString());
        $this->assertEquals($data['markdown'], $trip->markdown);
    }
}
