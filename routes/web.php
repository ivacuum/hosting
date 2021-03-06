<?php

use App\Http\Controllers as Ctrl;

Route::get('/', Ctrl\HomeController::class);

Route::view('about', 'about');

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

Route::get('comments/{comment}/confirm', Ctrl\CommentConfirm::class)->middleware('auth', 'can:confirm,comment');

Route::view('contact', 'issues.create');
Route::post('contact', Ctrl\Issues::class);

Route::middleware('nav:О DC++,dc')->group(function () {
    Route::view('dc', 'dcpp.index')->withoutMiddleware('nav:О DC++,dc');
    Route::view('dc/airdc', 'dcpp.airdc')->middleware('nav:dcpp.airdc');
    Route::view('dc/apexdc', 'dcpp.apexdc')->middleware('nav:dcpp.apexdc');
    Route::view('dc/clients', 'dcpp.clients')->middleware('nav:Клиенты');
    Route::view('dc/dcpp', 'dcpp.dcpp')->middleware('nav:dcpp.dcpp');
    Route::view('dc/faq', 'dcpp.faq')->middleware('nav:Вопросы и ответы');
    Route::view('dc/flylinkdc', 'dcpp.flylinkdc')->middleware('nav:dcpp.flylinkdc');
    Route::view('dc/greylinkdc', 'dcpp.greylinkdc')->middleware('nav:dcpp.greylinkdc');
    Route::get('dc/hubs', Ctrl\DcppHubs::class)->middleware('nav:Хабы');
    Route::post('dc/hubs/{hub}/click', Ctrl\DcppHubClick::class);
    Route::view('dc/jucydc', 'dcpp.jucydc')->middleware('nav:dcpp.jucydc');
    Route::view('dc/kalugadc', 'dcpp.kalugadc')->middleware('nav:dcpp.kalugadc');
    Route::view('dc/pelinkdc', 'dcpp.pelinkdc')->middleware('nav:dcpp.pelinkdc');
    Route::view('dc/rus_setup', 'dcpp.rus_setup')->middleware('nav:dcpp.rus_setup');
    Route::view('dc/shakespeer', 'dcpp.shakespeer')->middleware('nav:dcpp.shakespeer');
    Route::view('dc/strongdc', 'dcpp.strongdc')->middleware('nav:dcpp.strongdc');
    Route::view('dc/strongdc_install', 'dcpp.strongdc_install')->middleware('nav:dcpp.strongdc_install');
});

Route::middleware('nav:Документация,docs')->group(function () {
    Route::view('docs', 'docs.index');
    Route::view('docs/amazon-s3', 'docs.amazon-s3')->middleware('nav:Amazon S3');
    Route::view('docs/freebsd', 'docs.freebsd')->middleware('nav:FreeBSD');
    Route::view('docs/nginx', 'docs.nginx')->middleware('nav:Nginx');
    Route::view('docs/trips', 'docs.trips')->middleware('nav:Поездки');
});

Route::get('files', [Ctrl\Files::class, 'index'])->middleware('nav:Файлы');
Route::get('files/{file}/dl', [Ctrl\Files::class, 'download']);

Route::middleware('nav:Галерея,gallery')->group(function () {
    Route::get('gallery', [Ctrl\Gallery::class, 'index'])->middleware('auth');
    Route::get('gallery/preview/{image}', [Ctrl\Gallery::class, 'preview'])->middleware('nav:Просмотр миниатюры');
    Route::view('gallery/upload', 'gallery.upload')->middleware('auth')->middleware('nav:Загрузка изображений');
    Route::post('gallery/upload', [Ctrl\Gallery::class, 'store'])->middleware('auth');
    Route::get('gallery/view/{image}', [Ctrl\Gallery::class, 'view'])->middleware('nav:Просмотр изображения');
});

Route::middleware('nav:Японский язык,japanese')->group(function () {
    Route::view('japanese', 'japanese.index');
    Route::view('japanese/hiragana-katakana', 'japanese.hiragana-katakana')->middleware('nav:Хирагана и катакана');

    Route::middleware('nav:WaniKani V,japanese/wanikani')->group(function () {
        Route::view('japanese/wanikani', 'japanese.wanikani.index');
        Route::get('japanese/wanikani/kanji', [Ctrl\JapaneseWanikaniKanji::class, 'index'])->middleware('nav:japanese.kanji');
        Route::get('japanese/wanikani/kanji/{character}', [Ctrl\JapaneseWanikaniKanji::class, 'show']);
        Route::view('japanese/wanikani/level', 'japanese.wanikani.levels')->middleware('nav:Уровни');
        Route::get('japanese/wanikani/level/{level}', Ctrl\WanikaniLevel::class);
        Route::get('japanese/wanikani/radicals', [Ctrl\JapaneseWanikaniRadicals::class, 'index'])->middleware('nav:japanese.radicals');
        Route::get('japanese/wanikani/radicals/{meaning}', [Ctrl\JapaneseWanikaniRadicals::class, 'show']);
        Route::get('japanese/wanikani/vocabulary', [Ctrl\JapaneseWanikaniVocabulary::class, 'index'])->middleware('nav:japanese.vocabulary');
        Route::get('japanese/wanikani/vocabulary/{characters}', [Ctrl\JapaneseWanikaniVocabulary::class, 'show']);
    });

    Route::view('japanese/words-trainer', 'japanese.words-trainer')->middleware('nav:Тренажер по набору слов хираганой и катаканой');
});

Route::post('js/typo', Ctrl\JsTypo::class);

Route::middleware('nav:Корейский язык,korean')->group(function () {
    Route::view('korean', 'korean.index');
    Route::view('korean/hangul', 'korean.hangul')->middleware('nav:Хангыль');

    Route::middleware('nav:Кириллизация песен PSY,korean/psy')->group(function () {
        Route::get('korean/psy', Ctrl\KoreanPsy::class);
        Route::get('korean/psy/{song}', Ctrl\KoreanPsySong::class);
    });
});

Route::middleware('nav:Заметки,life')->group(function () {
    Route::get('life', [Ctrl\Life::class, 'index']);
    Route::view('life/books', 'life.books')->middleware('nav:Понравившиеся книги');
    Route::get('life/calendar', Ctrl\Calendar::class)->middleware('nav:Календарь поездок');
    Route::view('life/chillout', 'life.chillout')->middleware('nav:Chillout');
    Route::get('life/cities', [Ctrl\Life::class, 'cities'])->middleware('nav:Города');
    Route::get('life/countries', [Ctrl\Life::class, 'countries'])->middleware('nav:Страны');
    Route::get('life/countries/{slug}', [Ctrl\Life::class, 'country'])->middleware('nav:Страны,life/countries');
    Route::view('life/english', 'life.english')->middleware('nav:Английский');
    Route::view('life/favorite-posts', 'life.favorite-posts')->middleware('nav:Любимые посты');
    Route::view('life/german', 'life.german')->middleware('nav:Немецкий');
    Route::get('life/gigs', [Ctrl\Life::class, 'gigs'])->middleware('nav:Концерты');
    Route::get('life/gigs/rss', Ctrl\GigsRss::class);
    Route::view('life/laundry', 'life.laundry')->middleware('nav:Условные обозначения стирки');
    Route::get('life/movies', Ctrl\Movies::class)->middleware('nav:Любимые фильмы и сериалы');
    Route::view('life/podcasts', 'life.podcasts')->middleware('nav:Подкасты');
    Route::get('life/rss', Ctrl\TripsRss::class);
    Route::view('life/using-in-travels', 'life.using-in-travels')->middleware('nav:Чем пользуюсь в путешествиях');
    Route::get('life/{slug}', [Ctrl\Life::class, 'page']);
});

Route::get('mail/click/{timestamp}/{id}', [Ctrl\Mail::class, 'click'])->name('mail.click');
Route::get('mail/report/{timestamp}/{id}', [Ctrl\Mail::class, 'report'])->middleware('auth');
Route::get('mail/view/{timestamp}/{id}', [Ctrl\Mail::class, 'view']);

Route::middleware('auth')->group(function () {
    Route::view('my', 'my.index');
    Route::put('my/avatar', [Ctrl\MyAvatar::class, 'update']);
    Route::delete('my/avatar', [Ctrl\MyAvatar::class, 'destroy']);
    Route::get('my/password', [Ctrl\MyPassword::class, 'edit']);
    Route::put('my/password', [Ctrl\MyPassword::class, 'update']);
    Route::get('my/profile', [Ctrl\MyProfile::class, 'edit']);
    Route::put('my/profile', [Ctrl\MyProfile::class, 'update']);
    Route::get('my/settings', [Ctrl\MySettings::class, 'edit']);
    Route::put('my/settings', [Ctrl\MySettings::class, 'update']);

    Route::get('my/trips', [Ctrl\MyTrips::class, 'index']);
    Route::post('my/trips', [Ctrl\MyTrips::class, 'store']);
    Route::get('my/trips/create', [Ctrl\MyTrips::class, 'create']);
    Route::put('my/trips/{trip}', [Ctrl\MyTrips::class, 'update'])->middleware('can:user-update,trip');
    Route::delete('my/trips/{trip}', [Ctrl\MyTrips::class, 'destroy'])->middleware('can:user-delete,trip');
    Route::get('my/trips/{trip}/edit', [Ctrl\MyTrips::class, 'edit'])->middleware('can:user-update,trip');
});

Route::get('news', [Ctrl\NewsController::class, 'index'])->middleware('nav:Новости,news');
Route::get('news/rss', Ctrl\NewsRss::class);
Route::get('news/{id}', [Ctrl\NewsController::class, 'show'])->middleware('nav:Новости,news');
Route::get('news/{year}/{month}', Ctrl\NewsBc::class);
Route::get('news/{year}/{month}/{day}', Ctrl\NewsBc::class);
Route::get('news/{year}/{month}/{day}/{slug}', Ctrl\NewsBc::class);

Route::get('notifications', [Ctrl\Notifications::class, 'index'])->middleware('auth');

Route::get('parser/vk/{page?}/{date?}', [Ctrl\ParserVk::class, 'index'])->where('date', '\d{4}-\d{2}-\d{2}');
Route::post('parser/vk', [Ctrl\ParserVk::class, 'indexPost']);

Route::middleware('nav:Фотки,photos')->group(function () {
    Route::get('photos', [Ctrl\Photos::class, 'index']);

    Route::middleware('nav:Города,photos/cities')->group(function () {
        Route::get('photos/cities', [Ctrl\Photos::class, 'cities']);
        Route::get('photos/cities/{slug}', [Ctrl\Photos::class, 'city']);
    });

    Route::middleware('nav:Страны,photos/countries')->group(function () {
        Route::get('photos/countries', [Ctrl\Photos::class, 'countries']);
        Route::get('photos/countries/{slug}', [Ctrl\Photos::class, 'country']);
    });

    Route::view('photos/faq', 'photos.faq')->middleware('nav:Помощь,photos/faq');
    Route::get('photos/map', [Ctrl\Photos::class, 'map'])->middleware('nav:Карта,photos/map');

    Route::middleware('nav:Тэги,photos/tags')->group(function () {
        Route::get('photos/tags', [Ctrl\Photos::class, 'tags']);
        Route::get('photos/tags/{tag}', [Ctrl\Photos::class, 'tag']);
    });

    Route::middleware('nav:Поездки,photos/trips')->group(function () {
        Route::get('photos/trips', [Ctrl\Photos::class, 'trips']);
        Route::get('photos/trips/{trip}', [Ctrl\Photos::class, 'trip']);
    });

    Route::get('photos/{photo}', [Ctrl\Photos::class, 'show']);
});

Route::view('privacy-policy', 'privacy-policy');

Route::middleware('nav:coupons.index,promocodes-coupons')->group(function () {
    Route::view('promocodes-coupons', 'coupons.index');
    Route::get('promocodes-coupons/airbnb', [Ctrl\Coupons::class, 'airbnb'])->middleware('nav:coupons.airbnb');
    Route::get('promocodes-coupons/booking', [Ctrl\Coupons::class, 'booking'])->middleware('nav:coupons.booking');
    Route::get('promocodes-coupons/digitalocean', [Ctrl\Coupons::class, 'digitalocean'])->middleware('nav:coupons.digitalocean');
    Route::get('promocodes-coupons/drimsim', [Ctrl\Coupons::class, 'drimsim'])->middleware('nav:coupons.drimsim');
    Route::view('promocodes-coupons/firstvds', 'coupons.firstvds')->middleware('nav:coupons.firstvds');
    Route::post('promocodes-coupons/firstvds', [Ctrl\Coupons::class, 'firstvds']);
    Route::get('promocodes-coupons/timeweb', [Ctrl\Coupons::class, 'timeweb'])->middleware('nav:coupons.timeweb');
});

Route::view('retracker', 'retracker.index');
Route::view('retracker/dev', 'retracker.dev');
Route::view('retracker/usage', 'retracker.usage');

Route::view('stickers', 'stickers');

Route::get('subscriptions', [Ctrl\Subscriptions::class, 'edit']);
Route::post('subscriptions', [Ctrl\Subscriptions::class, 'store']);
Route::put('subscriptions', [Ctrl\Subscriptions::class, 'update'])->middleware('auth');
Route::get('subscriptions/confirm', [Ctrl\Subscriptions::class, 'confirm'])->middleware('auth');

Route::get('torrent', Ctrl\TorrentPromo::class);

Route::get('torrents', [Ctrl\Torrents::class, 'index']);
Route::post('torrents', [Ctrl\Torrents::class, 'store']);
Route::view('torrents/add', 'torrents.create');
Route::get('torrents/comments', [Ctrl\Torrents::class, 'comments']);
Route::get('torrents/faq', [Ctrl\Torrents::class, 'faq']);
Route::get('torrents/my', [Ctrl\Torrents::class, 'my'])->middleware('auth');
Route::post('torrents/request', Ctrl\TorrentRequestRelease::class);
Route::get('torrents/{torrent}', [Ctrl\Torrents::class, 'show'])->middleware('nav:Торренты,torrents');
Route::post('torrents/{torrent}/magnet', [Ctrl\Torrents::class, 'magnet']);

Route::get('trips/{trip}', [Ctrl\Trips::class, 'show']);

Route::view('up', 'upload');
Route::post('up', Ctrl\Upload::class);

Route::middleware('nav:Пользователи,users')->group(function () {
    Route::get('users', [Ctrl\Users::class, 'index']);
    Route::get('users/{id}', [Ctrl\Users::class, 'show']);
});

Route::get('@{login}', [Ctrl\UserHome::class, 'index']);
Route::get('@{login}/travel', [Ctrl\UserTravelTrips::class, 'index']);
Route::get('@{login}/travel/cities', [Ctrl\UserTravelCities::class, 'index']);
Route::get('@{login}/travel/cities/{slug}', [Ctrl\UserTravelCities::class, 'show']);
Route::get('@{login}/travel/countries', [Ctrl\UserTravelCountries::class, 'index']);
Route::get('@{login}/travel/countries/{slug}', [Ctrl\UserTravelCountries::class, 'show']);
Route::get('@{login}/travel/{slug}', [Ctrl\UserTravelTrips::class, 'show']);

Route::get('.well-known/change-password', Ctrl\WellKnownChangePassword::class);
