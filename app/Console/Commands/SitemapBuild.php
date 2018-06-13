<?php namespace App\Console\Commands;

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

        $this->appendCouponPages();
        $this->appendDcppPages();
        $this->appendGigs();
        $this->appendJapanesePages();
        $this->appendLifePages();
        $this->appendNews();
        $this->appendTrips();
    }

    protected function appendCouponPages()
    {
        $this->page([
            'promocodes-coupons/airbnb',
            'promocodes-coupons/booking',
            'promocodes-coupons/digitalocean',
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
        foreach (Gig::query()
                     ->select(['id', 'slug'])
                     ->where('status', Gig::STATUS_PUBLISHED)
                     ->orderBy('id')
                     ->cursor() as $model) {
            $this->page("life/{$model->slug}", '0.7');
            $this->page("en/life/{$model->slug}", '0.7');
        }
    }

    protected function appendJapanesePages()
    {
        $this->page([
            'japanese',
            'japanese/hiragana-katakana',

            'en/japanese/hiragana-katakana',
            'en/japanese/hiragana-katakana',
        ], ['0.5', '0.6', '0.7']);
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

        foreach (News::query()
            ->select(['id', 'locale'])
            ->published()
            ->orderBy('id')
            ->cursor() as $model) {
            $prefix = $model->locale === 'ru' ? '' : "{$model->locale}/";

            $this->page("{$prefix}news/{$model->id}", '0.2');
        }
    }

    protected function appendTrips()
    {
        foreach (Trip::query()
            ->select(['id', 'user_id', 'slug'])
            ->where('user_id', 1)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->orderBy('id')
            ->cursor() as $model) {
            $this->page("life/{$model->slug}", '0.7');
            $this->page("en/life/{$model->slug}", '0.7');
        }
    }
}
