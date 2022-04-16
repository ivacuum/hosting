<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->be(UserFactory::new()->withId(1)->make())
            ->get('my')
            ->assertOk();
    }
}
