<?php namespace Tests\Feature;

use App\Factory\RadicalFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniRadicalTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $radical = RadicalFactory::new()->create();

        $this->be($user = UserFactory::new()->create())
            ->delete("japanese/wanikani/radicals/{$radical->id}")
            ->assertNoContent();

        $this->assertSame($user->id, $radical->burnable->user_id);
    }

    public function testIndex()
    {
        $this->get('japanese/wanikani/radicals')
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testIndexJson()
    {
        $level = 60;
        $radical = RadicalFactory::new()->withLevel($level)->create();

        $json = $this->getJson('japanese/wanikani/radicals')
            ->assertStatus(200)
            ->json("data.{$level}");

        $this->assertContains($radical->id, array_column($json, 'id'));
    }

    public function testShow()
    {
        $radical = RadicalFactory::new()->create();

        $this->get("japanese/wanikani/radicals/{$radical->meaning}")
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testShowJson()
    {
        $radical = RadicalFactory::new()->create();

        $this->getJson("japanese/wanikani/radicals/{$radical->meaning}")
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $radical->id]]);
    }

    public function testResurrect()
    {
        $this->be($user = UserFactory::new()->create());

        $radical = RadicalFactory::new()->create();
        $radical->burn($user->id);

        $this->put("japanese/wanikani/radicals/{$radical->id}")
            ->assertNoContent();

        $this->assertNull($radical->burnable);
    }
}
