<?php

use App\Http\Controllers;

Route::get('/', Controllers\HomeController::class);

Route::get('about', Controllers\AboutController::class);

Route::get('auth/login', [Controllers\Auth\SignIn::class, 'index'])->middleware('guest');
Route::post('auth/login', [Controllers\Auth\SignIn::class, 'login'])->middleware('guest');
Route::get('auth/logout', [Controllers\Auth\SignIn::class, 'logout'])->middleware('auth');

Route::get('auth/register', [Controllers\Auth\NewAccount::class, 'index'])->middleware('guest');
Route::post('auth/register', [Controllers\Auth\NewAccount::class, 'register'])->middleware('guest');
Route::get('auth/register/confirm/{token}', [Controllers\Auth\NewAccount::class, 'confirm'])->middleware('guest');

Route::get('auth/password/remind', [Controllers\Auth\ForgotPassword::class, 'index'])->middleware('guest');
Route::post('auth/password/remind', [Controllers\Auth\ForgotPassword::class, 'sendResetLink']);

Route::get('auth/password/reset/{token}', [Controllers\Auth\ResetPassword::class, 'index']);
Route::post('auth/password/reset', [Controllers\Auth\ResetPassword::class, 'reset']);

// OAuth
Route::get('auth/facebook', [Controllers\Auth\Facebook::class, 'index']);
Route::get('auth/facebook/callback', [Controllers\Auth\Facebook::class, 'callback']);
Route::get('auth/google', [Controllers\Auth\Google::class, 'index']);
Route::get('auth/google/callback', [Controllers\Auth\Google::class, 'callback']);
Route::get('auth/vk', [Controllers\Auth\Vk::class, 'index']);
Route::get('auth/vk/callback', [Controllers\Auth\Vk::class, 'callback']);

Route::post('ajax/comment/{type}/{id}', [Controllers\AjaxComment::class, 'store']);

Route::get('comments/{comment}/confirm', [Controllers\CommentConfirm::class, 'update'])->middleware('auth', 'can:confirm,comment');

Route::get('contact', [Controllers\Issues::class, 'create']);
Route::post('contact', [Controllers\Issues::class, 'store']);

Route::get('dc', [Controllers\Dcpp::class, 'index']);
Route::get('dc/hubs', [Controllers\DcppHubs::class, 'index']);
Route::post('dc/hubs/{hub}/click', [Controllers\DcppHubClick::class, 'store']);
Route::get('dc/{slug}', [Controllers\Dcpp::class, 'page']);

Route::get('docs', [Controllers\Docs::class, 'index']);
Route::get('docs/{slug}', [Controllers\Docs::class, 'page']);

Route::get('files', [Controllers\Files::class, 'index']);
Route::get('files/{file}/dl', [Controllers\Files::class, 'download']);

Route::get('gallery', [Controllers\Gallery::class, 'index'])->middleware('auth');
Route::get('gallery/preview/{image}', [Controllers\Gallery::class, 'preview']);
Route::get('gallery/view/{image}', [Controllers\Gallery::class, 'view']);
Route::get('gallery/upload', [Controllers\Gallery::class, 'upload'])->middleware('auth');
Route::post('gallery/upload', [Controllers\Gallery::class, 'store'])->middleware('auth');

Route::get('japanese', Controllers\JapaneseController::class);
Route::get('japanese/hiragana-katakana', [Controllers\JapaneseHiraganaKatakana::class, 'index']);
Route::get('japanese/wanikani', Controllers\WanikaniController::class);
Route::get('japanese/wanikani/kanji', [Controllers\JapaneseWanikaniKanji::class, 'index']);
Route::get('japanese/wanikani/kanji/{character}', [Controllers\JapaneseWanikaniKanji::class, 'show']);
Route::get('japanese/wanikani/level', Controllers\WanikaniLevelsController::class);
Route::get('japanese/wanikani/level/{level}', Controllers\WanikaniLevelController::class);
Route::get('japanese/wanikani/radicals', [Controllers\JapaneseWanikaniRadicals::class, 'index']);
Route::get('japanese/wanikani/radicals/{meaning}', [Controllers\JapaneseWanikaniRadicals::class, 'show']);
Route::get('japanese/wanikani/vocabulary', [Controllers\JapaneseWanikaniVocabulary::class, 'index']);
Route::get('japanese/wanikani/vocabulary/{characters}', [Controllers\JapaneseWanikaniVocabulary::class, 'show']);
Route::get('japanese/words-trainer', Controllers\JapaneseWordsTrainerController::class);

Route::post('js/typo', Controllers\JsTypo::class);

Route::get('korean', Controllers\KoreanController::class);
Route::get('korean/psy', Controllers\KoreanPsyController::class);
Route::get('korean/psy/{song}', Controllers\KoreanPsySongController::class);

Route::get('life', [Controllers\Life::class, 'index']);
Route::get('life/calendar', [Controllers\Life::class, 'calendar']);
Route::get('life/cities', [Controllers\Life::class, 'cities']);
Route::get('life/countries', [Controllers\Life::class, 'countries']);
Route::get('life/countries/{slug}', [Controllers\Life::class, 'country']);
Route::get('life/gigs', [Controllers\Life::class, 'gigs']);
Route::get('life/gigs/rss', [Controllers\LifeGigsRss::class, 'index']);
Route::get('life/rss', [Controllers\LifeTripsRss::class, 'index']);
Route::get('life/{slug}', [Controllers\Life::class, 'page']);

Route::get('mail/click/{timestamp}/{id}', [Controllers\Mail::class, 'click'])->name('mail.click');
Route::get('mail/report/{timestamp}/{id}', [Controllers\Mail::class, 'report'])->middleware('auth');
Route::get('mail/view/{timestamp}/{id}', [Controllers\Mail::class, 'view']);

Route::get('my', [Controllers\My::class, 'index'])->middleware('auth');
Route::put('my/avatar', [Controllers\MyAvatar::class, 'update'])->middleware('auth');
Route::delete('my/avatar', [Controllers\MyAvatar::class, 'destroy'])->middleware('auth');
Route::get('my/password', [Controllers\MyPassword::class, 'edit'])->middleware('auth');
Route::put('my/password', [Controllers\MyPassword::class, 'update'])->middleware('auth');
Route::get('my/profile', [Controllers\MyProfile::class, 'edit'])->middleware('auth');
Route::put('my/profile', [Controllers\MyProfile::class, 'update'])->middleware('auth');
Route::get('my/settings', [Controllers\MySettings::class, 'edit'])->middleware('auth');
Route::put('my/settings', [Controllers\MySettings::class, 'update'])->middleware('auth');

Route::get('my/trips', [Controllers\MyTrips::class, 'index'])->middleware('auth');
Route::post('my/trips', [Controllers\MyTrips::class, 'store'])->middleware('auth');
Route::get('my/trips/create', [Controllers\MyTrips::class, 'create'])->middleware('auth');
Route::put('my/trips/{trip}', [Controllers\MyTrips::class, 'update'])->middleware('auth', 'can:user-update,trip');
Route::delete('my/trips/{trip}', [Controllers\MyTrips::class, 'destroy'])->middleware('auth', 'can:user-delete,trip');
Route::get('my/trips/{trip}/edit', [Controllers\MyTrips::class, 'edit'])->middleware('auth', 'can:user-update,trip');

Route::get('news', [Controllers\News::class, 'index']);
Route::get('news/rss', [Controllers\NewsRss::class, 'index']);
Route::get('news/{id}', [Controllers\News::class, 'show']);
Route::get('news/{year}/{month}', [Controllers\News::class, 'bc']);
Route::get('news/{year}/{month}/{day}', [Controllers\News::class, 'bc']);
Route::get('news/{year}/{month}/{day}/{slug}', [Controllers\News::class, 'bc']);

Route::get('notifications', [Controllers\Notifications::class, 'index'])->middleware('auth');

Route::get('parser/vk/{page?}/{date?}', [Controllers\ParserVk::class, 'index'])->where('date', '\d{4}-\d{2}-\d{2}');
Route::post('parser/vk', [Controllers\ParserVk::class, 'indexPost']);

Route::get('photos', [Controllers\Photos::class, 'index']);
Route::get('photos/cities', [Controllers\Photos::class, 'cities']);
Route::get('photos/cities/{slug}', [Controllers\Photos::class, 'city']);
Route::get('photos/countries', [Controllers\Photos::class, 'countries']);
Route::get('photos/countries/{slug}', [Controllers\Photos::class, 'country']);
Route::get('photos/faq', [Controllers\Photos::class, 'faq']);
Route::get('photos/map', [Controllers\Photos::class, 'map']);
Route::get('photos/tags', [Controllers\Photos::class, 'tags']);
Route::get('photos/tags/{tag}', [Controllers\Photos::class, 'tag']);
Route::get('photos/trips', [Controllers\Photos::class, 'trips']);
Route::get('photos/trips/{trip}', [Controllers\Photos::class, 'trip']);
Route::get('photos/{photo}', [Controllers\Photos::class, 'show']);

Route::get('promocodes-coupons', [Controllers\Coupons::class, 'index']);
Route::get('promocodes-coupons/airbnb', [Controllers\Coupons::class, 'airbnb']);
Route::get('promocodes-coupons/booking', [Controllers\Coupons::class, 'booking']);
Route::get('promocodes-coupons/digitalocean', [Controllers\Coupons::class, 'digitalocean']);
Route::get('promocodes-coupons/drimsim', [Controllers\Coupons::class, 'drimsim']);
Route::get('promocodes-coupons/firstvds', [Controllers\Coupons::class, 'firstvds']);
Route::post('promocodes-coupons/firstvds', [Controllers\Coupons::class, 'firstvdsPost']);
Route::get('promocodes-coupons/timeweb', [Controllers\Coupons::class, 'timeweb']);

Route::get('retracker', [Controllers\Retracker::class, 'index']);
Route::get('retracker/dev', [Controllers\Retracker::class, 'dev']);
Route::get('retracker/usage', [Controllers\Retracker::class, 'usage']);

Route::get('stickers', [Controllers\Stickers::class, 'index']);

Route::get('subscriptions', [Controllers\Subscriptions::class, 'edit']);
Route::post('subscriptions', [Controllers\Subscriptions::class, 'store']);
Route::put('subscriptions', [Controllers\Subscriptions::class, 'update'])->middleware('auth');
Route::get('subscriptions/confirm', [Controllers\Subscriptions::class, 'confirm'])->middleware('auth');

Route::get('torrent', [Controllers\TorrentPromo::class, 'index']);

Route::get('torrents', [Controllers\Torrents::class, 'index']);
Route::post('torrents', [Controllers\Torrents::class, 'store']);
Route::get('torrents/add', [Controllers\Torrents::class, 'create']);
Route::get('torrents/comments', [Controllers\Torrents::class, 'comments']);
Route::get('torrents/faq', [Controllers\Torrents::class, 'faq']);
Route::get('torrents/my', [Controllers\Torrents::class, 'my'])->middleware('auth');
Route::get('torrents/{torrent}', [Controllers\Torrents::class, 'show']);
Route::post('torrents/{torrent}/magnet', [Controllers\Torrents::class, 'magnet']);

Route::get('trips/{trip}', [Controllers\Trips::class, 'show']);

Route::get('up', [Controllers\UploadController::class, 'index']);
Route::post('up', [Controllers\UploadController::class, 'store']);

Route::get('users', [Controllers\Users::class, 'index']);
Route::get('users/{id}', [Controllers\Users::class, 'show']);

Route::get('@{login}', [Controllers\UserHome::class, 'index']);
Route::get('@{login}/travel', [Controllers\UserTravelTrips::class, 'index']);
Route::get('@{login}/travel/cities', [Controllers\UserTravelCities::class, 'index']);
Route::get('@{login}/travel/cities/{slug}', [Controllers\UserTravelCities::class, 'show']);
Route::get('@{login}/travel/countries', [Controllers\UserTravelCountries::class, 'index']);
Route::get('@{login}/travel/countries/{slug}', [Controllers\UserTravelCountries::class, 'show']);
Route::get('@{login}/travel/{slug}', [Controllers\UserTravelTrips::class, 'show']);

Route::get('.well-known/change-password', Controllers\WellKnownChangePasswordController::class);
