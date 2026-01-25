<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class AppendViewSharedVarsActionTest extends TestCase
{
    use DatabaseTransactions;

    public function testViewVarsCssClasses()
    {
        $this->get('/')
            ->assertViewHas('cssClasses', 'is-desktop');

        $this->withHeader('User-Agent', 'iPhone')
            ->get('/')
            ->assertViewHas('cssClasses', 'is-mobile ios');
    }

    public function testViewVarsFirstTimeVisit()
    {
        $this->get('/')
            ->assertViewHas('firstTimeVisit', true);

        session(['_previous.url' => 'http://localhost/news']);

        $this->get('/')
            ->assertViewHas('firstTimeVisit', false);
    }

    #[TestWith(['/', null])]
    #[TestWith(['/?goto=/news', '/news'])]
    public function testViewVarsGoto(string $url, string|null $expected)
    {
        $this->get($url)
            ->assertViewHas('goto', $expected);
    }

    public function testViewVarsIsCrawler()
    {
        $this->get('/')
            ->assertViewHas('isCrawler', false);

        $this->withHeader('User-Agent', 'Googlebot')
            ->get('/')
            ->assertViewHas('isCrawler', true);
    }

    public function testViewVarsIsDesktop()
    {
        $this->get('/')
            ->assertViewHas('isDesktop', true);

        $this->withHeader('User-Agent', 'iPhone')
            ->get('/')
            ->assertViewHas('isDesktop', false);
    }

    public function testViewVarsIsMobile()
    {
        $this->get('/')
            ->assertViewHas('isMobile', false);

        $this->withHeader('User-Agent', 'iPhone')
            ->get('/')
            ->assertViewHas('isMobile', true);
    }

    #[TestWith(['/', 'ru'])]
    #[TestWith(['en', 'en'])]
    public function testViewVarsLocale(string $url, string $expected)
    {
        $this->get($url)
            ->assertViewHas('locale', $expected);
    }

    #[TestWith(['en', 'en'])]
    #[TestWith(['ru', 'ru'])]
    public function testViewVarsLocalePreferred(string $acceptLanguage, string $expected)
    {
        $this->withHeader('Accept-Language', $acceptLanguage)
            ->get('/')
            ->assertViewHas('localePreferred', $expected);
    }

    #[TestWith(['/', ''])]
    #[TestWith(['en', '/en'])]
    public function testViewVarsLocaleUri(string $url, string $expected)
    {
        $this->get($url)
            ->assertViewHas('localeUri', $expected);
    }

    #[TestWith(['/', '/'])]
    #[TestWith(['en', ''])]
    #[TestWith(['about', 'about'])]
    #[TestWith(['en/about', 'about'])]
    #[TestWith(['korean/psy/everyday', 'korean/psy/everyday'])]
    #[TestWith(['en/korean/psy/everyday', 'korean/psy/everyday'])]
    public function testViewVarsRequestUri(string $url, string $expected)
    {
        $this->get($url)
            ->assertViewHas('requestUri', $expected);
    }

    #[TestWith(['/', '/'])]
    #[TestWith(['en', '/'])]
    #[TestWith(['about', 'about'])]
    #[TestWith(['en/about', 'about'])]
    #[TestWith(['korean/psy/everyday', 'korean/psy/{song}'])]
    #[TestWith(['en/korean/psy/everyday', 'korean/psy/{song}'])]
    public function testViewVarsRouteUri(string $url, string $expected)
    {
        $this->get($url)
            ->assertViewHas('routeUri', $expected);
    }

    #[TestWith(['/', 'home'])]
    #[TestWith(['news', 'news'])]
    #[TestWith(['korean/psy/everyday', 'korean-psy-song'])]
    public function testViewVarsTpl(string $url, string $expected)
    {
        $this->get($url)
            ->assertViewHas('tpl', $expected);
    }

    #[TestWith(['/', 'home'])]
    #[TestWith(['news', 'news.index'])]
    #[TestWith(['korean/psy/everyday', 'korean-psy-song'])]
    public function testViewVarsView(string $url, string $expected)
    {
        $this->get($url)
            ->assertViewHas('view', $expected);
    }
}
