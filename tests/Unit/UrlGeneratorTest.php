<?php namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UrlGeneratorTest extends TestCase
{
    use DatabaseTransactions;

    /** @dataProvider english */
    public function testEn(array $input, string $result)
    {
        request()->server->set('LARAVEL_LOCALE', 'en');

        $this->assertSame($result, to(...$input));
    }

    /** @dataProvider russian */
    public function testRu(array $input, string $result)
    {
        request()->server->remove('LARAVEL_LOCALE');

        $this->assertSame($result, to(...$input));
    }

    public static function english()
    {
        yield [[''], '/en'];
        yield [['/'], '/en'];
        yield [['photos/1'], '/en/photos/1'];
        yield [['photos/1', ['city_id' => 5, 'tag_id' => 10]], '/en/photos/1?city_id=5&tag_id=10'];
        yield [['photos/countries/{country}', ['russia']], '/en/photos/countries/russia'];
    }

    public static function russian()
    {
        yield [[''], '/'];
        yield [['/'], '/'];
        yield [['photos/1'], '/photos/1'];
        yield [['photos/1', ['city_id' => 5, 'tag_id' => 10]], '/photos/1?city_id=5&tag_id=10'];
        yield [['photos/countries/{country}', ['russia']], '/photos/countries/russia'];
    }
}
