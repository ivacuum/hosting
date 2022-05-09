<?php namespace App\Providers;

use App;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        App\Utilities\CityHelper::class => App\Utilities\CityHelper::class,
        App\Utilities\CountryHelper::class => App\Utilities\CountryHelper::class,
    ];

    public function boot()
    {
        \Blade::withoutDoubleEncoding();
        \Blade::directive('lng', fn () => '<?php echo $localeUri ?>');
        Date::use(CarbonImmutable::class);

        Model::preventLazyLoading(!app()->isProduction());

        Relation::enforceMorphMap([
            'Gig' => App\Gig::class,
            'Tag' => App\Tag::class,
            'City' => App\City::class,
            'File' => App\File::class,
            'News' => App\News::class,
            'Trip' => App\Trip::class,
            'User' => App\User::class,
            'Image' => App\Image::class,
            'Issue' => App\Issue::class,
            'Kanji' => App\Kanji::class,
            'Photo' => App\Photo::class,
            'Artist' => App\Artist::class,
            'Client' => App\Client::class,
            'Domain' => App\Domain::class,
            'Comment' => App\Comment::class,
            'Country' => App\Country::class,
            'Radical' => App\Radical::class,
            'Torrent' => App\Magnet::class,
            'Vocabulary' => App\Vocabulary::class,
            'YandexUser' => App\YandexUser::class,
            'ChatMessage' => App\ChatMessage::class,
            'ExternalIdentity' => App\ExternalIdentity::class,
        ]);

        App\Gig::observe(App\Observers\GigObserver::class);
        App\Tag::observe(App\Observers\TagObserver::class);
        App\City::observe(App\Observers\CityObserver::class);
        App\News::observe(App\Observers\NewsObserver::class);
        App\Trip::observe(App\Observers\TripObserver::class);
        App\User::observe(App\Observers\UserObserver::class);
        App\Email::observe(App\Observers\EmailObserver::class);
        App\Image::observe(App\Observers\ImageObserver::class);
        App\Issue::observe(App\Observers\IssueObserver::class);
        App\Kanji::observe(App\Observers\KanjiObserver::class);
        App\Photo::observe(App\Observers\PhotoObserver::class);
        App\Artist::observe(App\Observers\ArtistObserver::class);
        App\Domain::observe(App\Observers\DomainObserver::class);
        App\Magnet::observe(App\Observers\MagnetObserver::class);
        App\Comment::observe(App\Observers\CommentObserver::class);
        App\Country::observe(App\Observers\CountryObserver::class);
        App\Radical::observe(App\Observers\RadicalObserver::class);
        App\Vocabulary::observe(App\Observers\VocabularyObserver::class);
        App\YandexUser::observe(App\Observers\YandexUserObserver::class);
        App\ChatMessage::observe(App\Observers\ChatMessageObserver::class);

        $this->appendViewSharedVars();
        $this->paginatorCurrentPath();
        $this->testMacros();
    }

    private function paginatorCurrentPath()
    {
        $locale = $this->app['request']->server->get('LARAVEL_LOCALE');
        $localeUri = $locale ? "/{$locale}" : '';

        Paginator::currentPathResolver(fn () => $localeUri . $this->app['request']->getBaseUrl() . $this->app['request']->getPathInfo());
    }

    private function appendViewSharedVars()
    {
        \View::composer('*', static function (View $view) {
            static $data;

            if ($data === null) {
                $request = request();
                $locale = $request->server->get('LARAVEL_LOCALE');
                $browserEnv = new \Ivacuum\Generic\Utilities\EnvironmentForCss($request->userAgent());
                $preferredLocale = $request->getPreferredLanguage(array_keys(config('cfg.locales')));

                $routeData = app(App\Action\ParseRouteDataAction::class)->execute();

                $data = [
                    'tpl' => $routeData->tpl,
                    'view' => $routeData->view,

                    'locale' => $locale ?: config('app.locale'),
                    'localeUri' => $locale ? "/{$locale}" : '',
                    'localePreferred' => $preferredLocale,

                    'goto' => $request->input('goto'),
                    'isMobile' => $browserEnv->isMobile(),
                    'routeUri' => $request->route()
                        ? $request->route()->uri()
                        : '',
                    'isCrawler' => $browserEnv->isCrawler(),
                    'isDesktop' => !$browserEnv->isMobile(),
                    'cssClasses' => (string) $browserEnv,
                    'requestUri' => $request->path(),
                    'firstTimeVisit' => \Session::previousUrl() === null,
                ];
            }

            $view->with($data);
        });
    }

    private function testMacros()
    {
        TestResponse::macro('assertHasCustomTitle', function () {
            Assert::assertStringNotContainsString('<title>' . config('cfg.sitename') . '</title>', $this->getContent());

            return $this;
        });
    }
}
