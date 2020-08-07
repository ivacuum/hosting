<?php

use App\Http\Controllers as Ctrl;

Route::get('/', Ctrl\HomeController::class);

Route::get('about', Ctrl\AboutController::class);

Route::get('auth/login', [Ctrl\Auth\SignIn::class, 'index'])->middleware('guest');
Route::post('auth/login', [Ctrl\Auth\SignIn::class, 'login'])->middleware('guest');
Route::get('auth/logout', [Ctrl\Auth\SignIn::class, 'logout'])->middleware('auth');

Route::get('auth/register', [Ctrl\Auth\NewAccount::class, 'index'])->middleware('guest');
Route::post('auth/register', [Ctrl\Auth\NewAccount::class, 'register'])->middleware('guest');
Route::get('auth/register/confirm/{token}', [Ctrl\Auth\NewAccount::class, 'confirm'])->middleware('guest');

Route::get('auth/password/remind', [Ctrl\Auth\ForgotPassword::class, 'index'])->middleware('guest');
Route::post('auth/password/remind', [Ctrl\Auth\ForgotPassword::class, 'sendResetLink']);

Route::get('auth/password/reset/{token}', [Ctrl\Auth\ResetPassword::class, 'index']);
Route::post('auth/password/reset', [Ctrl\Auth\ResetPassword::class, 'reset']);

// OAuth
Route::get('auth/facebook', [Ctrl\Auth\Facebook::class, 'index']);
Route::get('auth/facebook/callback', [Ctrl\Auth\Facebook::class, 'callback']);
Route::get('auth/google', [Ctrl\Auth\Google::class, 'index']);
Route::get('auth/google/callback', [Ctrl\Auth\Google::class, 'callback']);
Route::get('auth/vk', [Ctrl\Auth\Vk::class, 'index']);
Route::get('auth/vk/callback', [Ctrl\Auth\Vk::class, 'callback']);

Route::post('ajax/comment/{type}/{id}', [Ctrl\AjaxComment::class, 'store']);

Route::get('comments/{comment}/confirm', [Ctrl\CommentConfirm::class, 'update'])->middleware('auth', 'can:confirm,comment');

Route::get('contact', [Ctrl\Issues::class, 'create']);
Route::post('contact', [Ctrl\Issues::class, 'store']);

Route::get('dc', [Ctrl\Dcpp::class, 'index']);
Route::get('dc/hubs', [Ctrl\DcppHubs::class, 'index']);
Route::post('dc/hubs/{hub}/click', [Ctrl\DcppHubClick::class, 'store']);
Route::get('dc/{slug}', [Ctrl\Dcpp::class, 'page']);

Route::get('docs', [Ctrl\Docs::class, 'index']);
Route::get('docs/{slug}', [Ctrl\Docs::class, 'page']);

Route::get('files', [Ctrl\Files::class, 'index']);
Route::get('files/{file}/dl', [Ctrl\Files::class, 'download']);

Route::get('gallery', [Ctrl\Gallery::class, 'index'])->middleware('auth');
Route::get('gallery/preview/{image}', [Ctrl\Gallery::class, 'preview']);
Route::get('gallery/view/{image}', [Ctrl\Gallery::class, 'view']);
Route::get('gallery/upload', [Ctrl\Gallery::class, 'upload'])->middleware('auth');
Route::post('gallery/upload', [Ctrl\Gallery::class, 'store'])->middleware('auth');

Route::get('japanese', Ctrl\JapaneseController::class);
Route::get('japanese/hiragana-katakana', [Ctrl\JapaneseHiraganaKatakana::class, 'index']);
Route::get('japanese/wanikani', Ctrl\WanikaniController::class);
Route::get('japanese/wanikani/kanji', [Ctrl\JapaneseWanikaniKanji::class, 'index']);
Route::get('japanese/wanikani/kanji/{character}', [Ctrl\JapaneseWanikaniKanji::class, 'show']);
Route::get('japanese/wanikani/level', Ctrl\WanikaniLevelsController::class);
Route::get('japanese/wanikani/level/{level}', Ctrl\WanikaniLevelController::class);
Route::get('japanese/wanikani/radicals', [Ctrl\JapaneseWanikaniRadicals::class, 'index']);
Route::get('japanese/wanikani/radicals/{meaning}', [Ctrl\JapaneseWanikaniRadicals::class, 'show']);
Route::get('japanese/wanikani/vocabulary', [Ctrl\JapaneseWanikaniVocabulary::class, 'index']);
Route::get('japanese/wanikani/vocabulary/{characters}', [Ctrl\JapaneseWanikaniVocabulary::class, 'show']);
Route::get('japanese/words-trainer', Ctrl\JapaneseWordsTrainerController::class);

Route::post('js/typo', Ctrl\JsTypo::class);

Route::get('korean', Ctrl\KoreanController::class);
Route::get('korean/psy', Ctrl\KoreanPsyController::class);
Route::get('korean/psy/{song}', Ctrl\KoreanPsySongController::class);

Route::get('life', [Ctrl\Life::class, 'index']);
Route::get('life/calendar', [Ctrl\Life::class, 'calendar']);
Route::get('life/cities', [Ctrl\Life::class, 'cities']);
Route::get('life/countries', [Ctrl\Life::class, 'countries']);
Route::get('life/countries/{slug}', [Ctrl\Life::class, 'country']);
Route::get('life/gigs', [Ctrl\Life::class, 'gigs']);
Route::get('life/gigs/rss', [Ctrl\LifeGigsRss::class, 'index']);
Route::get('life/movies', Ctrl\MoviesController::class);
Route::get('life/rss', [Ctrl\LifeTripsRss::class, 'index']);
Route::get('life/{slug}', [Ctrl\Life::class, 'page']);

Route::get('mail/click/{timestamp}/{id}', [Ctrl\Mail::class, 'click'])->name('mail.click');
Route::get('mail/report/{timestamp}/{id}', [Ctrl\Mail::class, 'report'])->middleware('auth');
Route::get('mail/view/{timestamp}/{id}', [Ctrl\Mail::class, 'view']);

Route::get('my', [Ctrl\My::class, 'index'])->middleware('auth');
Route::put('my/avatar', [Ctrl\MyAvatar::class, 'update'])->middleware('auth');
Route::delete('my/avatar', [Ctrl\MyAvatar::class, 'destroy'])->middleware('auth');
Route::get('my/password', [Ctrl\MyPassword::class, 'edit'])->middleware('auth');
Route::put('my/password', [Ctrl\MyPassword::class, 'update'])->middleware('auth');
Route::get('my/profile', [Ctrl\MyProfile::class, 'edit'])->middleware('auth');
Route::put('my/profile', [Ctrl\MyProfile::class, 'update'])->middleware('auth');
Route::get('my/settings', [Ctrl\MySettings::class, 'edit'])->middleware('auth');
Route::put('my/settings', [Ctrl\MySettings::class, 'update'])->middleware('auth');

Route::get('my/trips', [Ctrl\MyTrips::class, 'index'])->middleware('auth');
Route::post('my/trips', [Ctrl\MyTrips::class, 'store'])->middleware('auth');
Route::get('my/trips/create', [Ctrl\MyTrips::class, 'create'])->middleware('auth');
Route::put('my/trips/{trip}', [Ctrl\MyTrips::class, 'update'])->middleware('auth', 'can:user-update,trip');
Route::delete('my/trips/{trip}', [Ctrl\MyTrips::class, 'destroy'])->middleware('auth', 'can:user-delete,trip');
Route::get('my/trips/{trip}/edit', [Ctrl\MyTrips::class, 'edit'])->middleware('auth', 'can:user-update,trip');

Route::get('news', [Ctrl\News::class, 'index']);
Route::get('news/rss', [Ctrl\NewsRss::class, 'index']);
Route::get('news/{id}', [Ctrl\News::class, 'show']);
Route::get('news/{year}/{month}', [Ctrl\News::class, 'bc']);
Route::get('news/{year}/{month}/{day}', [Ctrl\News::class, 'bc']);
Route::get('news/{year}/{month}/{day}/{slug}', [Ctrl\News::class, 'bc']);

Route::get('notifications', [Ctrl\Notifications::class, 'index'])->middleware('auth');

Route::get('parser/vk/{page?}/{date?}', [Ctrl\ParserVk::class, 'index'])->where('date', '\d{4}-\d{2}-\d{2}');
Route::post('parser/vk', [Ctrl\ParserVk::class, 'indexPost']);

Route::middleware('breadcrumbs:Фотки,photos')->group(function () {
    Route::get('photos', [Ctrl\Photos::class, 'index']);

    Route::middleware('breadcrumbs:Города,photos/cities')->group(function () {
        Route::get('photos/cities', [Ctrl\Photos::class, 'cities']);
        Route::get('photos/cities/{slug}', [Ctrl\Photos::class, 'city']);
    });

    Route::middleware('breadcrumbs:Страны,photos/countries')->group(function () {
        Route::get('photos/countries', [Ctrl\Photos::class, 'countries']);
        Route::get('photos/countries/{slug}', [Ctrl\Photos::class, 'country']);
    });

    Route::get('photos/faq', [Ctrl\Photos::class, 'faq'])->middleware('breadcrumbs:Помощь,photos/faq');
    Route::get('photos/map', [Ctrl\Photos::class, 'map'])->middleware('breadcrumbs:Карта,photos/map');

    Route::middleware('breadcrumbs:Тэги,photos/tags')->group(function () {
        Route::get('photos/tags', [Ctrl\Photos::class, 'tags']);
        Route::get('photos/tags/{tag}', [Ctrl\Photos::class, 'tag']);
    });


    Route::middleware('breadcrumbs:Поездки,photos/trips')->group(function () {
        Route::get('photos/trips', [Ctrl\Photos::class, 'trips']);
        Route::get('photos/trips/{trip}', [Ctrl\Photos::class, 'trip']);
    });

    Route::get('photos/{photo}', [Ctrl\Photos::class, 'show']);
});

Route::get('promocodes-coupons', [Ctrl\Coupons::class, 'index']);
Route::get('promocodes-coupons/airbnb', [Ctrl\Coupons::class, 'airbnb']);
Route::get('promocodes-coupons/booking', [Ctrl\Coupons::class, 'booking']);
Route::get('promocodes-coupons/digitalocean', [Ctrl\Coupons::class, 'digitalocean']);
Route::get('promocodes-coupons/drimsim', [Ctrl\Coupons::class, 'drimsim']);
Route::get('promocodes-coupons/firstvds', [Ctrl\Coupons::class, 'firstvds']);
Route::post('promocodes-coupons/firstvds', [Ctrl\Coupons::class, 'firstvdsPost']);
Route::get('promocodes-coupons/timeweb', [Ctrl\Coupons::class, 'timeweb']);

Route::get('retracker', [Ctrl\Retracker::class, 'index']);
Route::get('retracker/dev', [Ctrl\Retracker::class, 'dev']);
Route::get('retracker/usage', [Ctrl\Retracker::class, 'usage']);

Route::get('stickers', [Ctrl\Stickers::class, 'index']);

Route::get('subscriptions', [Ctrl\Subscriptions::class, 'edit']);
Route::post('subscriptions', [Ctrl\Subscriptions::class, 'store']);
Route::put('subscriptions', [Ctrl\Subscriptions::class, 'update'])->middleware('auth');
Route::get('subscriptions/confirm', [Ctrl\Subscriptions::class, 'confirm'])->middleware('auth');

Route::get('torrent', [Ctrl\TorrentPromo::class, 'index']);

Route::get('torrents', [Ctrl\Torrents::class, 'index']);
Route::post('torrents', [Ctrl\Torrents::class, 'store']);
Route::get('torrents/add', [Ctrl\Torrents::class, 'create']);
Route::get('torrents/comments', [Ctrl\Torrents::class, 'comments']);
Route::get('torrents/faq', [Ctrl\Torrents::class, 'faq']);
Route::get('torrents/my', [Ctrl\Torrents::class, 'my'])->middleware('auth');
Route::post('torrents/request', Ctrl\TorrentRequestReleaseController::class);
Route::get('torrents/{torrent}', [Ctrl\Torrents::class, 'show']);
Route::post('torrents/{torrent}/magnet', [Ctrl\Torrents::class, 'magnet']);

Route::get('trips/{trip}', [Ctrl\Trips::class, 'show']);

Route::get('up', [Ctrl\UploadController::class, 'index']);
Route::post('up', [Ctrl\UploadController::class, 'store']);

Route::get('users', [Ctrl\Users::class, 'index']);
Route::get('users/{id}', [Ctrl\Users::class, 'show']);

Route::get('@{login}', [Ctrl\UserHome::class, 'index']);
Route::get('@{login}/travel', [Ctrl\UserTravelTrips::class, 'index']);
Route::get('@{login}/travel/cities', [Ctrl\UserTravelCities::class, 'index']);
Route::get('@{login}/travel/cities/{slug}', [Ctrl\UserTravelCities::class, 'show']);
Route::get('@{login}/travel/countries', [Ctrl\UserTravelCountries::class, 'index']);
Route::get('@{login}/travel/countries/{slug}', [Ctrl\UserTravelCountries::class, 'show']);
Route::get('@{login}/travel/{slug}', [Ctrl\UserTravelTrips::class, 'show']);

Route::get('.well-known/change-password', Ctrl\WellKnownChangePasswordController::class);
