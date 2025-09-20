<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class UrlGeneratorTest extends TestCase
{
    use DatabaseTransactions;

    #[TestWith([[''], '/en'])]
    #[TestWith([['/'], '/en'])]
    #[TestWith([['photos/1'], '/en/photos/1'])]
    #[TestWith([['photos/1', ['city_id' => 5, 'tag_id' => 10]], '/en/photos/1?city_id=5&tag_id=10'])]
    #[TestWith([['photos/countries/{country}', ['russia']], '/en/photos/countries/russia'])]
    public function testEn(array $input, string $result)
    {
        request()->server->set('LARAVEL_LOCALE', 'en');

        $this->assertSame($result, to(...$input));
    }

    #[TestWith([[''], '/'])]
    #[TestWith([['/'], '/'])]
    #[TestWith([['photos/1'], '/photos/1'])]
    #[TestWith([['photos/1', ['city_id' => 5, 'tag_id' => 10]], '/photos/1?city_id=5&tag_id=10'])]
    #[TestWith([['photos/countries/{country}', ['russia']], '/photos/countries/russia'])]
    public function testRu(array $input, string $result)
    {
        request()->server->remove('LARAVEL_LOCALE');

        $this->assertSame($result, to(...$input));
    }
}
