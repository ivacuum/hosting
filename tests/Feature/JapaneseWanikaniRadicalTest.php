<?php namespace Tests\Feature;

use App\Http\Controllers\JapaneseWanikaniRadicals;
use App\Radical;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniRadicalTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $this->be($user = $this->user());

        $radical = $this->radical();

        $this->delete(action([JapaneseWanikaniRadicals::class, 'destroy'], $radical))
            ->assertNoContent();

        $this->assertEquals($user->id, $radical->burnable->user_id);
    }

    public function testIndex()
    {
        $this->get(action([JapaneseWanikaniRadicals::class, 'index']))
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testIndexJson()
    {
        $level = 60;
        $radical = $this->radical(['level' => $level]);

        $json = $this->getJson(action([JapaneseWanikaniRadicals::class, 'index']))
            ->assertStatus(200)
            ->json("data.{$level}");

        $this->assertContains($radical->id, array_column($json, 'id'));
    }

    public function testShow()
    {
        $radical = $this->radical();

        $this->get($radical->www())
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testShowJson()
    {
        $radical = $this->radical();

        $this->getJson($radical->www())
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $radical->id]]);
    }

    public function testResurrect()
    {
        $this->be($user = $this->user());

        $radical = $this->radical();
        $radical->burn($user->id);

        $this->put(action([JapaneseWanikaniRadicals::class, 'update'], $radical))
            ->assertNoContent();

        $this->assertNull($radical->burnable);
    }

    private function radical(array $attributes = []): Radical
    {
        return factory(Radical::class)->create($attributes);
    }

    private function user(): User
    {
        return factory(User::class)->create();
    }
}
