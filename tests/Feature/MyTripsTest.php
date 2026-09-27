<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\CityFactory;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\TripStatus;
use App\Factory\UserFactory;
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
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit'))
            ->create();

        $this->be($trip->user)
            ->get('my/trips')
            ->assertOk();
    }

    public function testStore()
    {
        $markdown = <<<'MARKDOWN'
            **Safe Markdown** and <b>untrusted HTML</b>.

            <script>alert('unsafe')</script>

            <img src="invalid" onerror="alert('unsafe')">

            [Unsafe link](javascript:alert%281%29)

            ![Markdown image](https://example.com/markdown.jpg)

            https://example.com/single.jpg

            https://example.com/first.jpg
            https://example.com/second.png

            `<b>Code example</b>`
            MARKDOWN;

        $city = CityFactory::new()
            ->withTitle('phpunit city ru', 'phpunit city en')
            ->create();

        $user = UserFactory::new()->create();

        $this->be($user)
            ->post('my/trips', [
                'slug' => 'phpunit',
                'status' => TripStatus::Published->value,
                'city_id' => $city->id,
                'date_end' => '2025-01-08',
                'markdown' => $markdown,
                'title_en' => 'phpunit EN',
                'title_ru' => 'phpunit RU',
                'date_start' => '2025-01-01',
            ])
            ->assertRedirect('my/trips');

        $trip = Trip::query()->whereBelongsTo($user)->first();

        $this->assertSame('phpunit city en', $trip->title_en);
        $this->assertSame('phpunit city ru', $trip->title_ru);
        $this->assertSame($markdown, $trip->markdown);

        $html = $trip->html;

        $this->assertStringNotContainsString('<script', $html);
        $this->assertStringNotContainsString('<b>', $html);
        $this->assertStringNotContainsString('onerror=', $html);
        $this->assertStringNotContainsString('href="javascript:', $html);
        $this->assertStringContainsString('<strong>Safe Markdown</strong>', $html);
        $this->assertStringContainsString('src="https://example.com/markdown.jpg"', $html);
        $this->assertStringContainsString('data-src="https://example.com/single.jpg"', $html);
        $this->assertStringContainsString('data-src="https://example.com/first.jpg"', $html);
        $this->assertStringContainsString('data-src="https://example.com/second.png"', $html);
        $this->assertStringContainsString('<code>&lt;b&gt;Code example&lt;/b&gt;</code>', $html);
    }

    public function testUpdate()
    {
        $trip = TripFactory::new()->withUser()->create();

        $this->be($trip->user)
            ->put("my/trips/{$trip->id}", [
                'slug' => 'phpunit',
                'status' => $trip->status->value,
                'city_id' => $trip->city_id,
                'title_en' => 'phpunit EN',
                'title_ru' => 'phpunit RU',
                'date_end' => '2018-12-31',
                'markdown' => 'Some formatted *markdown*',
                'date_start' => '2018-01-01 01:23:45',
            ])
            ->assertRedirect('my/trips');

        $trip->refresh();

        $this->assertSame('phpunit', $trip->slug);
        $this->assertSame('phpunit EN', $trip->title_en);
        $this->assertSame('phpunit RU', $trip->title_ru);
        $this->assertSame('2018-12-31 00:00:00', $trip->date_end->toDateTimeString());
        $this->assertSame('2018-01-01 01:23:45', $trip->date_start->toDateTimeString());
        $this->assertSame('Some formatted *markdown*', $trip->markdown);
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
