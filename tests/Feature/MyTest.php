<?php namespace Tests\Feature;

use App\Http\Controllers\My;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->be(factory(User::class)->state('id')->make())
            ->get(action([My::class, 'index']))
            ->assertStatus(200);
    }
}
