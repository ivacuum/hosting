<?php

namespace App\Console\Commands;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Country;
use App\Domain\Life\Models\Gig;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripOfAdminScope;
use App\Domain\Life\Scope\TripPublishedScope;
use App\News;
use App\Scope\NewsPublishedScope;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:sitemap-build')]
class SitemapBuild extends Command
{
    protected $signature = 'app:sitemap-build {threshold=50000}';
    protected $description = 'Build sitemap.xml';

    protected $now;
    protected $count = 0;
    protected $pages = [];
    protected $prefix;
    protected $multiple = false;
    protected $threshold = 50000;

    public function handle()
    {
        $this->init();
        $this->pages();
        $this->write();

        if ($this->multiple) {
            $this->writeSitemapIndex();
        }

        $this->move();
    }

    protected function incrementCounter(): void
    {
        $this->count++;

        if (!$this->multiple && $this->count >= $this->threshold) {
            $this->multiple = true;
        }
    }

    protected function init(): void
    {
        $this->purge();

        $this->now = now()->toDateString();
        $this->prefix = url('');
        $this->threshold = $this->argument('threshold');
    }

    protected function move(): void
    {
        $touched = ['sitemap.xml'];

        @mkdir(public_path('uploads/sitemaps'));

        /* Перенос сформированных файлов */
        rename(public_path('uploads/temp/sitemap.xml'), public_path('uploads/sitemaps/sitemap.xml'));

        foreach (glob(public_path('uploads/temp/sitemap-*.xml.gz')) as $filepath) {
            $filename = basename($filepath);

            rename($filepath, public_path("uploads/sitemaps/{$filename}"));

            $touched[] = $filename;
        }

        foreach (glob(public_path('uploads/sitemaps/sitemap*')) as $filepath) {
            if (!in_array(basename($filepath), $touched)) {
                unlink($filepath);
            }
        }
    }

    protected function page($locs, $priorities = '1', string $changefreq = 'daily', string $lastmod = ''): void
    {
        foreach (\Arr::wrap($locs) as $loc) {
            $lastmod = $lastmod ?: $this->now;

            $this->pages[] = [
                'loc' => "{$this->prefix}/{$loc}",
                'lastmod' => $lastmod,
                'changefreq' => $changefreq,
                'priority' => is_array($priorities)
                    ? \Arr::random($priorities)
                    : $priorities,
            ];

            $this->incrementCounter();

            if ($this->count % $this->threshold === 0) {
                $this->write();
            }
        }
    }

    protected function pages()
    {
        $this->page('');
        $this->page('retracker', '0.3');
        $this->page('retracker/dev', '0.3');
        $this->page('retracker/usage', '0.3');
        $this->page('torrent');

        $this->page('en');

        $this->appendCitiesAndCountries();
        $this->appendCouponPages();
        $this->appendDcppPages();
        $this->appendGigs();
        $this->appendJapanesePages();
        $this->appendKoreanPages();
        $this->appendLifePages();
        $this->appendNews();
        $this->appendTrips();
    }

    protected function purge()
    {
        @unlink(public_path('uploads/temp/sitemap.xml'));

        foreach (glob(public_path('uploads/temp/sitemap-*.xml.gz')) as $filename) {
            unlink($filename);
        }
    }

    /**
     * @return bool|resource
     */
    protected function sitemapToStream()
    {
        $stream = fopen('php://memory', 'r+');

        fwrite($stream, '<?xml version="1.0" encoding="UTF-8"?>' . "\n");
        fwrite($stream, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n");

        foreach ($this->pages as $page) {
            fwrite(
                $stream,
                sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%s</priority></url>',
                    $page['loc'],
                    $page['lastmod'],
                    $page['changefreq'],
                    $page['priority']
                )
            );
        }

        fwrite($stream, '</urlset>');

        $this->pages = [];

        return $stream;
    }

    protected function write(): void
    {
        if (!count($this->pages)) {
            return;
        }

        $this->multiple
            ? $this->writePartialSitemap()
            : $this->writeSingleSitemap();
    }

    protected function writePartialSitemap(): void
    {
        $stream = $this->sitemapToStream();

        rewind($stream);

        $part = ceil($this->count / $this->threshold);

        file_put_contents('compress.zlib://' . public_path("uploads/temp/sitemap-{$part}.xml.gz"), $stream);
    }

    protected function writeSingleSitemap(): void
    {
        \Storage::disk('temp')->put('sitemap.xml', $this->sitemapToStream());
    }

    protected function writeSitemapIndex(): void
    {
        $parts = ceil($this->count / $this->threshold);
        $stream = fopen('php://memory', 'r+');

        fwrite($stream, '<?xml version="1.0" encoding="UTF-8"?>' . "\n");
        fwrite($stream, '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n");

        foreach (range(1, $parts) as $part) {
            fwrite(
                $stream,
                sprintf(
                    '<sitemap><loc>%s</loc><lastmod>%s</lastmod></sitemap>',
                    "{$this->prefix}/uploads/sitemaps/sitemap-{$part}.xml.gz",
                    $this->now
                )
            );
        }

        fwrite($stream, '</sitemapindex>');

        \Storage::disk('temp')->put('sitemap.xml', $stream);
    }

    private function appendCitiesAndCountries()
    {
        Country::allWithCitiesAndTrips(1)
            ->filter(fn (Country $country) => $country->trips_published_count)
            ->each(function (Country $country) {
                $this->page("life/countries/{$country->slug}", '0.2');
                $this->page("en/life/countries/{$country->slug}", '0.2');

                $country->cities
                    ->filter(fn (City $city) => $city->trips_published_count)
                    ->each(function (City $city) {
                        $this->page("life/{$city->slug}", '0.2');
                        $this->page("en/life/{$city->slug}", '0.2');
                    });
            });
    }

    private function appendCouponPages()
    {
        $this->page([
            'promocodes-coupons/airbnb',
            'promocodes-coupons/booking',
            'promocodes-coupons/digitalocean',
            'promocodes-coupons/drimsim',
            'promocodes-coupons/firstvds',
            'promocodes-coupons/timeweb',

            'en/promocodes-coupons/airbnb',
            'en/promocodes-coupons/booking',
            'en/promocodes-coupons/digitalocean',
        ], ['0.5', '0.6', '0.7']);
    }

    private function appendDcppPages()
    {
        $this->page([
            'dc',
            'dc/airdc',
            'dc/apexdc',
            'dc/dcpp',
            'dc/faq',
            'dc/flylinkdc',
            'dc/greylinkdc',
            'dc/hubs',
            'dc/jucydc',
            'dc/kalugadc',
            'dc/pelinkdc',
            'dc/rus_setup',
            'dc/shakespeer',
            'dc/strongdc',
            'dc/strongdc_install',

            'en/dc',
            'en/dc/airdc',
            'en/dc/apexdc',
            'en/dc/dcpp',
            'en/dc/flylinkdc',
            'en/dc/greylinkdc',
            'en/dc/hubs',
            'en/dc/jucydc',
            'en/dc/pelinkdc',
            'en/dc/shakespeer',
            'en/dc/strongdc',
        ], ['0.5', '0.6', '0.7']);
    }

    private function appendGigs()
    {
        foreach ($this->gigModels() as $model) {
            $this->page("life/{$model->slug}", '0.7');
            $this->page("en/life/{$model->slug}", '0.7');
        }
    }

    private function appendJapanesePages()
    {
        $this->page([
            'japanese',
            'japanese/hiragana-katakana',
            'japanese/words-trainer',

            'en/japanese/hiragana-katakana',
            'en/japanese/words-trainer',
        ], ['0.5', '0.6', '0.7']);
    }

    private function appendKoreanPages()
    {
        $this->page([
            'korean',
            'korean/hangul',
            'korean/psy',
            'korean/psy/all-night-long',
            'korean/psy/as-time-goes-by',
            'korean/psy/celeb',
            'korean/psy/daddy',
            'korean/psy/dont-worry-my-dear',
            'korean/psy/dream',
            'korean/psy/entertainer',
            'korean/psy/everyday',
            'korean/psy/father',
            'korean/psy/gangnam-style',
            'korean/psy/gentleman',
            'korean/psy/i-am-a-guy-like-this',
            'korean/psy/i-luv-it',
            'korean/psy/in-my-eyes',
            'korean/psy/its-art',
            'korean/psy/last-scene',
            'korean/psy/napal-baji',
            'korean/psy/new-face',
            'korean/psy/paradise',
            'korean/psy/place-to-lean-on',
            'korean/psy/right-now',
            'korean/psy/shake-it',
            'korean/psy/someday',
            'korean/psy/that-that',
            'korean/psy/the-end',
            'korean/psy/we-are-the-one',
            'korean/psy/what-would-have-been',
            'korean/psy/white-night',
            'korean/psy/you-move-me',
        ], ['0.4']);
    }

    private function appendLifePages()
    {
        $this->page([
            'life',
            'life/books',
            'life/calendar',
            'life/chillout',
            'life/cities',
            'life/countries',
            'life/favorite-posts',
            'life/gigs',
            'life/laundry',
            'life/movies',
            'life/podcasts',
            'life/using-in-travels',

            'en/life',
            'en/life/calendar',
            'en/life/cities',
            'en/life/countries',
            'en/life/gigs',
        ], ['0.5', '0.6', '0.7']);
    }

    private function appendNews()
    {
        $this->page('news', '0.2');

        foreach ($this->newsModels() as $model) {
            $prefix = $model->locale->isRussian() ? '' : "{$model->locale->value}/";

            $this->page("{$prefix}news/{$model->id}", '0.2');
        }
    }

    private function appendTrips()
    {
        foreach ($this->tripModels() as $model) {
            $this->page("life/{$model->slug}", '0.7');
            $this->page("en/life/{$model->slug}", '0.7');
        }
    }

    /** @return \Illuminate\Support\LazyCollection<int, Gig> */
    private function gigModels()
    {
        return Gig::query()
            ->select(['id', 'slug'])
            ->where('status', GigStatus::Published)
            ->lazyById();
    }

    /** @return \Illuminate\Support\LazyCollection<int, News> */
    private function newsModels()
    {
        return News::query()
            ->select(['id', 'locale'])
            ->tap(new NewsPublishedScope)
            ->lazyById();
    }

    /** @return \Illuminate\Support\LazyCollection<int, Trip> */
    private function tripModels()
    {
        return Trip::query()
            ->select(['id', 'user_id', 'slug'])
            ->tap(new TripOfAdminScope)
            ->tap(new TripPublishedScope)
            ->lazyById();
    }
}
