<?php

namespace App\Providers;

use App;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::withoutDoubleEncoding();
        Blade::directive('lng', fn () => '<?php echo $localeUri ?>');
        Blade::stringable(fn (\BackedEnum $enum) => $enum->value);
        Date::use(CarbonImmutable::class);
        Vite::useBuildDirectory('assets');

        Model::preventLazyLoading(!app()->isProduction());
        Model::preventAccessingMissingAttributes();
        Model::preventSilentlyDiscardingAttributes();

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
            'Magnet' => App\Magnet::class,
            'Comment' => App\Comment::class,
            'Country' => App\Country::class,
            'Radical' => App\Radical::class,
            'Vocabulary' => App\Vocabulary::class,
            'ChatMessage' => App\ChatMessage::class,
            'ExternalIdentity' => App\ExternalIdentity::class,
        ]);

        $this->testMacros();
    }

    private function testMacros()
    {
        TestResponse::macro('assertHasCustomTitle', function () {
            /** @var TestResponse $this */
            Assert::assertStringNotContainsString('<title>' . App\Domain\Config::SiteName->get() . '</title>', $this->getContent());

            return $this;
        });
    }
}
