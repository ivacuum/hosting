<?php namespace Tests\Feature;

use App\Http\Controllers\JapaneseWanikani;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action([JapaneseWanikani::class, 'index']))
            ->assertStatus(200);
    }
}
