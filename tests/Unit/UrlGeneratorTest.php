<?php

namespace Tests\Unit;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class UrlGeneratorTest extends TestCase
{
    use DatabaseTransactions;

    public function testCanonical()
    {
        app('url')->useOrigin('http://localhost');

        $this->get('news?foo=bar');

        $this->assertSame('http://localhost/news', canonical());

        $this->get('en/news?foo=bar');

        $this->assertSame('http://localhost/en/news', canonical());
    }

    public function testFullUrl()
    {
        app('url')->useOrigin('http://localhost');

        $this->get('news?foo=bar');

        $this->assertSame('http://localhost/news?', fullUrl(['foo' => null]));
        $this->assertSame('http://localhost/news?foo=bar', fullUrl());
        $this->assertSame('http://localhost/news?foo=bar&baz=qux', fullUrl(['baz' => 'qux']));

        $this->get('en/news?foo=bar');

        $this->assertSame('http://localhost/en/news?', fullUrl(['foo' => null]));
        $this->assertSame('http://localhost/en/news?foo=bar', fullUrl());
        $this->assertSame('http://localhost/en/news?foo=bar&baz=qux', fullUrl(['baz' => 'qux']));
    }

    public function testPath()
    {
        $this->assertSame('/', path(HomeController::class));
        $this->assertSame('/news/123', path([NewsController::class, 'show'], 123));
        $this->assertSame('/news/123', path([NewsController::class, 'show'], ['id' => 123]));

        request()->server->set('LARAVEL_LOCALE', 'en');

        $this->assertSame('/en', path(HomeController::class));
        $this->assertSame('/en/news/123', path([NewsController::class, 'show'], 123));
        $this->assertSame('/en/news/123', path([NewsController::class, 'show'], ['id' => 123]));
    }

    public function testPathLocale()
    {
        $this->assertSame('/en', path_locale(HomeController::class, [], false, 'en'));
        $this->assertSame('/en/news/123', path_locale([NewsController::class, 'show'], 123, false, 'en'));

        $this->assertSame('/', path_locale(HomeController::class, [], false, 'ru'));
        $this->assertSame('/news/123', path_locale([NewsController::class, 'show'], 123, false, 'ru'));
    }

    #[TestWith([[''], '/en'])]
    #[TestWith([['/'], '/en'])]
    #[TestWith([['photos/1'], '/en/photos/1'])]
    #[TestWith([['photos/1', ['city_id' => 5, 'tag_id' => 10]], '/en/photos/1?city_id=5&tag_id=10'])]
    #[TestWith([['photos/countries/{country}', ['russia']], '/en/photos/countries/russia'])]
    public function testToEn(array $input, string $result)
    {
        request()->server->set('LARAVEL_LOCALE', 'en');

        $this->assertSame($result, to(...$input));
    }

    #[TestWith([[''], '/'])]
    #[TestWith([['/'], '/'])]
    #[TestWith([['photos/1'], '/photos/1'])]
    #[TestWith([['photos/1', ['city_id' => 5, 'tag_id' => 10]], '/photos/1?city_id=5&tag_id=10'])]
    #[TestWith([['photos/countries/{country}', ['russia']], '/photos/countries/russia'])]
    public function testToRu(array $input, string $result)
    {
        request()->server->remove('LARAVEL_LOCALE');

        $this->assertSame($result, to(...$input));
    }
}
