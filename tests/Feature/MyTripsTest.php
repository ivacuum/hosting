<?php namespace Tests\Feature;

use App\Factory\TripFactory;
use App\Factory\UserFactory;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyTripsTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->be(UserFactory::new()->withId(1)->make())
            ->get('my/trips/create')
            ->assertOk();
    }

    public function testDestroy()
    {
        $trip = TripFactory::new()->withUser()->create();

        $this->be($trip->user)
            ->delete("my/trips/{$trip->id}")
            ->assertRedirect('my/trips');

        $this->assertDatabaseMissing($trip->getTable(), ['id' => $trip->id]);
    }

    public function testDestroyForbidden()
    {
        $trip = TripFactory::new()->withUser()->create();
        $cheater = UserFactory::new()->create();

        $this->be($cheater)
            ->delete("my/trips/{$trip->id}")
            ->assertForbidden();
    }

    public function testEdit()
    {
        $trip = TripFactory::new()->withUser()->create();

        $this->be($trip->user)
            ->get("my/trips/{$trip->id}/edit")
            ->assertOk();
    }

    public function testEditForbidden()
    {
        $trip = TripFactory::new()->withUser()->create();
        $cheater = UserFactory::new()->create();

        $this->be($cheater)
            ->get("my/trips/{$trip->id}/edit")
            ->assertForbidden();
    }

    public function testIndex()
    {
        $trip = TripFactory::new()->withUser()->create();

        $this->be($trip->user)
            ->get('my/trips')
            ->assertOk();
    }

    public function testStore()
    {
        $trip = TripFactory::new()->make();
        $user = UserFactory::new()->create();

        $this->be($user)
            ->post('my/trips', $trip->attributesToArray())
            ->assertRedirect('my/trips');

        $tripSaved = Trip::whereBelongsTo($trip->city)->first();

        $this->assertSame($trip->city->title_en, $tripSaved->title_en);
        $this->assertSame($trip->city->title_ru, $tripSaved->title_ru);
    }

    public function testUpdate()
    {
        $trip = TripFactory::new()->withUser()->create();

        $data = [
            'slug' => '_new-slug_',
            'title_en' => 'title EN',
            'title_ru' => 'title RU',
            'date_end' => '2018-12-31',
            'markdown' => 'some formatted *markdown*',
            'date_start' => '2018-01-01',
        ];

        $this->be($trip->user)
            ->put("my/trips/{$trip->id}", array_merge($trip->attributesToArray(), $data))
            ->assertRedirect('my/trips');

        $trip->refresh();

        $this->assertSame($data['slug'], $trip->slug);
        $this->assertSame($data['title_en'], $trip->title_en);
        $this->assertSame($data['title_ru'], $trip->title_ru);
        $this->assertSame($data['date_end'], $trip->date_end->toDateString());
        $this->assertSame($data['date_start'], $trip->date_start->toDateString());
        $this->assertSame($data['markdown'], $trip->markdown);
    }

    public function testUpdateForbidden()
    {
        $trip = TripFactory::new()->withUser()->create();
        $cheater = UserFactory::new()->create();

        $this->be($cheater)
            ->put("my/trips/{$trip->id}")
            ->assertForbidden();
    }
}
