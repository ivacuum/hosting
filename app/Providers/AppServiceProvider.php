<?php

namespace App\Providers;

use App;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::withoutDoubleEncoding();
        Blade::directive('ru', fn () => '<?php if ($locale === "ru"): ?>');
        Blade::directive('en', fn () => '<?php elseif ($locale === "en"): ?>');
        Blade::directive('de', fn () => '<?php elseif ($locale === "de"): ?>');
        Blade::directive('endru', fn () => '<?php endif; ?>');
        Blade::directive('lng', fn () => '<?php echo $localeUri ?>');
        Blade::directive('svg', fn ($expression) => "<?php require base_path(\"resources/svg/$expression.svg\"); ?>");
        Blade::stringable(fn (\BackedEnum $enum) => $enum->value);
        Date::use(CarbonImmutable::class);
        Vite::useBuildDirectory('assets');

        Model::automaticallyEagerLoadRelationships();
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventAccessingMissingAttributes();
        Model::preventSilentlyDiscardingAttributes();

        Relation::enforceMorphMap([
            'Gig' => App\Domain\Life\Models\Gig::class,
            'Tag' => App\Domain\Life\Models\Tag::class,
            'City' => App\Domain\Life\Models\City::class,
            'File' => App\File::class,
            'News' => App\News::class,
            'Trip' => App\Domain\Life\Models\Trip::class,
            'User' => App\User::class,
            'Image' => App\Image::class,
            'Issue' => App\Issue::class,
            'Kanji' => App\Domain\Wanikani\Models\Kanji::class,
            'Photo' => App\Domain\Life\Models\Photo::class,
            'Artist' => App\Domain\Life\Models\Artist::class,
            'Magnet' => App\Domain\Magnet\Models\Magnet::class,
            'Comment' => App\Comment::class,
            'Country' => App\Domain\Life\Models\Country::class,
            'Radical' => App\Domain\Wanikani\Models\Radical::class,
            'Vocabulary' => App\Domain\Wanikani\Models\Vocabulary::class,
            'ChatMessage' => App\ChatMessage::class,
            'ExternalIdentity' => App\ExternalIdentity::class,
        ]);

        /**
         * Обработка доходит до метода только при заполненном значении,
         * то есть всегда провал, если дошло до обработки
         */
        \Validator::extend('empty', function () {
            event(new \App\Events\Stats\SpammerTrapped);

            return false;
        }, 'Читер');

        $this->livewireSharedVarsWorkaroundForTests();
        $this->testMacros();
    }

    private function livewireSharedVarsWorkaroundForTests(): void
    {
        // Middleware в автотестах компонентов Livewire не запускаются,
        // поэтому нужно помочь передать локаль, иначе в шаблонах не работает @ru
        if (app()->runningUnitTests()) {
            View::composer('*', App\Domain\Blade\LivewirePhpUnitViewComposer::class);
        }
    }

    private function testMacros()
    {
        TestResponse::macro('assertHasCustomTitle', function () {
            /** @var TestResponse $this */
            Assert::assertStringNotContainsString('<title>' . App\Domain\Config::SiteName->get() . '</title>', (string) $this->getContent());

            return $this;
        });
    }
}
