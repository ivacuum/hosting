<?php namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->be(factory(User::class)->state('id')->make())
            ->get('my')
            ->assertStatus(200);
    }
}
