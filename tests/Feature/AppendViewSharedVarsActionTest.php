<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
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

    public function testViewVarsGoto()
    {
        $this->get('/')
            ->assertViewHas('goto', null);

        $this->get('/?goto=/news')
            ->assertViewHas('goto', '/news');
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

    public function testViewVarsLocale()
    {
        $this->get('/')
            ->assertViewHas('locale', 'ru');

        $this->get('en')
            ->assertViewHas('locale', 'en');
    }

    public function testViewVarsLocalePreferred()
    {
        $this->withHeader('Accept-Language', 'ru')
            ->get('/')
            ->assertViewHas('localePreferred', 'ru');

        $this->withHeader('Accept-Language', 'en')
            ->get('/')
            ->assertViewHas('localePreferred', 'en');
    }

    public function testViewVarsLocaleUri()
    {
        $this->get('/')
            ->assertViewHas('localeUri', '');

        $this->get('en')
            ->assertViewHas('localeUri', '/en');
    }

    public function testViewVarsRequestUri()
    {
        $this->get('/')
            ->assertViewHas('requestUri', '/');

        $this->get('about')
            ->assertViewHas('requestUri', 'about');
    }

    public function testViewVarsRouteUri()
    {
        $this->get('/')
            ->assertViewHas('routeUri', '/');

        $this->get('about')
            ->assertViewHas('routeUri', 'about');
    }

    public function testViewVarsTpl()
    {
        $this->get('/')
            ->assertViewHas('tpl', 'home');

        $this->get('news')
            ->assertViewHas('tpl', 'news');
    }

    public function testViewVarsView()
    {
        $this->get('/')
            ->assertViewHas('view', 'home');

        $this->get('news')
            ->assertViewHas('view', 'news.index');
    }
}
