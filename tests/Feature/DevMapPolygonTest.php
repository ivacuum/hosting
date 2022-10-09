<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DevMapPolygonTest extends TestCase
{
    use DatabaseTransactions;

    public function testEmpty()
    {
        $this->get('dev/map-polygon')
            ->assertOk();
    }

    public function testWithInvalidWkt()
    {
        $this->get('dev/map-polygon?wkt=invalid')
            ->assertOk();
    }

    public function testWithValidWkt()
    {
        $this->get('dev/map-polygon?wkt=' . urlencode('POLYGON((36 55, 37 55, 37 54, 36 54, 36 55))'))
            ->assertOk();
    }
}
