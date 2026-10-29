<?php

namespace App\Providers;

use App;
use App\Domain\Log\FailedHttpTransferStats;
use Carbon\CarbonImmutable;
use GuzzleHttp\TransferStats;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::withoutDoubleEncoding();
        Blade::directive('ru', static fn () => '<?php if (($__locale ??= app()->getLocale()) === "ru"): ?>');
        Blade::directive('en', static fn () => '<?php elseif ($__locale === "en"): ?>');
        Blade::directive('de', static fn () => '<?php elseif ($__locale === "de"): ?>');
        Blade::directive('endru', static fn () => '<?php endif; ?>');
        Blade::directive('lng', static fn () => '<?php echo $localeUri ?>');
        Blade::directive('svg', static function ($expression) {
            $icon = trim($expression, " '\"()");
            $path = base_path("resources/svg/{$icon}.svg");

            if (is_file($path)) {
                return file_get_contents($path);
            }

            if (!str_contains($icon, '$')) {
                throw new \InvalidArgumentException("SVG icon [{$icon}] not found at {$path}");
            }

            return "<?php require base_path(\"resources/svg/{$expression}.svg\"); ?>";
        });
        Blade::stringable(static fn (\BackedEnum $enum) => $enum->value);
        Date::use(CarbonImmutable::class);
        FormRequest::failOnUnknownFields(!app()->isProduction());
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

        Http::globalOptions([
            'on_stats' => static fn (TransferStats $stats) => app(FailedHttpTransferStats::class)->remember($stats),
        ]);

        $this->parallelTestingSetUpDatabase();
        $this->testMacros();
    }

    private function parallelTestingSetUpDatabase(): void
    {
        ParallelTesting::setUpTestDatabase(static function () {
            // Часть функционала сайта завязана на user_id=1
            App\Factory\UserFactory::new()->root()->create();
        });
    }

    private function testMacros(): void
    {
        TestResponse::macro('assertHasCustomTitle', function () {
            /** @var TestResponse $this */
            Assert::assertStringNotContainsString('<title>' . App\Domain\Config::SiteName->get() . '</title>', (string) $this->getContent());

            return $this;
        });
    }
}
