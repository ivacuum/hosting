<?php namespace Tests\Feature;

use App\Http\Controllers\Japanese;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action([Japanese::class, 'index']))
            ->assertStatus(200);
    }
}
