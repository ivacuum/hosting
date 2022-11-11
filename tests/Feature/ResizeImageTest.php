<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ResizeImageTest extends TestCase
{
    use DatabaseTransactions;

    public function testNoExtension()
    {
        $this->get('resize/400x300?image=https://example.com/image')
            ->assertUnprocessable();
    }

    public function testNotWhitelisted()
    {
        $this->get('resize/400x300?image=https://example.com/image.jpg')
            ->assertForbidden();
    }
}
