<?php namespace App\Console\Commands;

use App\City;
use App\Country;
use App\Domain\TripStatus;
use App\Gig;
use App\News;
use App\Trip;
use Ivacuum\Generic\Commands\SitemapBuild as BaseSitemapBuild;

class SitemapBuild extends BaseSitemapBuild
{
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

    protected function appendCitiesAndCountries()
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

    protected function appendCouponPages()
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

    protected function appendDcppPages()
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

    protected function appendGigs()
    {
        /** @var Gig $model */
        foreach ($this->gigModels() as $model) {
            $this->page("life/{$model->slug}", '0.7');
            $this->page("en/life/{$model->slug}", '0.7');
        }
    }

    protected function appendJapanesePages()
    {
        $this->page([
            'japanese',
            'japanese/hiragana-katakana',
            'japanese/words-trainer',

            'en/japanese/hiragana-katakana',
            'en/japanese/words-trainer',
        ], ['0.5', '0.6', '0.7']);
    }

    protected function appendKoreanPages()
    {
        $this->page([
            'korean',
            'korean/psy',
            'korean/psy/all-night-long',
            'korean/psy/as-time-goes-by',
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
            'korean/psy/the-end',
            'korean/psy/we-are-the-one',
            'korean/psy/what-would-have-been',
            'korean/psy/white-night',
        ], ['0.4']);
    }

    protected function appendLifePages()
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

    protected function appendNews()
    {
        $this->page('news', '0.2');

        /** @var News $model */
        foreach ($this->newsModels() as $model) {
            $prefix = $model->locale === 'ru' ? '' : "{$model->locale}/";

            $this->page("{$prefix}news/{$model->id}", '0.2');
        }
    }

    protected function appendTrips()
    {
        /** @var Trip $model */
        foreach ($this->tripModels() as $model) {
            $this->page("life/{$model->slug}", '0.7');
            $this->page("en/life/{$model->slug}", '0.7');
        }
    }

    protected function gigModels()
    {
        return Gig::query()
            ->select(['id', 'slug'])
            ->where('status', Gig::STATUS_PUBLISHED)
            ->orderBy('id')
            ->lazy();
    }

    protected function newsModels()
    {
        return News::query()
            ->select(['id', 'locale'])
            ->published()
            ->orderBy('id')
            ->lazy();
    }

    protected function tripModels()
    {
        return Trip::query()
            ->select(['id', 'user_id', 'slug'])
            ->where('user_id', 1)
            ->where('status', TripStatus::Published)
            ->orderBy('id')
            ->lazy();
    }
}
