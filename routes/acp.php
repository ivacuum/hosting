<?php

Route::get('/', 'Acp\Home@index');

Route::group(['prefix' => 'artists'], function () {
    Route::get('/', 'Acp\Artists@index');
    Route::post('/', 'Acp\Artists@store');
    Route::get('create', 'Acp\Artists@create');
    Route::get('{Artist}', 'Acp\Artists@show');
    Route::put('{Artist}', 'Acp\Artists@update');
    Route::delete('{Artist}', 'Acp\Artists@destroy');
    Route::get('{Artist}/edit', 'Acp\Artists@edit');
});

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', 'Acp\Cities@index');
    Route::post('/', 'Acp\Cities@store');
    Route::get('create', 'Acp\Cities@create');
    Route::get('{City}', 'Acp\Cities@show');
    Route::put('{City}', 'Acp\Cities@update');
    Route::delete('{City}', 'Acp\Cities@destroy');
    Route::get('{City}/edit', 'Acp\Cities@edit');
    Route::get('{City}/geo', 'Acp\Cities@updateGeo');
});

Route::group(['prefix' => 'clients'], function () {
    Route::get('/', 'Acp\Clients@index');
    Route::post('/', 'Acp\Clients@store');
    Route::get('create', 'Acp\Clients@create');
    Route::get('{Client}', 'Acp\Clients@show');
    Route::put('{Client}', 'Acp\Clients@update');
    Route::delete('{Client}', 'Acp\Clients@destroy');
    Route::get('{Client}/edit', 'Acp\Clients@edit');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', 'Acp\Comments@index');
    Route::get('{Comment}', 'Acp\Comments@show');
    Route::put('{Comment}', 'Acp\Comments@update');
    Route::delete('{Comment}', 'Acp\Comments@destroy');
    Route::get('{Comment}/edit', 'Acp\Comments@edit');
});

Route::group(['prefix' => 'countries'], function () {
    Route::get('/', 'Acp\Countries@index');
    Route::post('/', 'Acp\Countries@store');
    Route::get('create', 'Acp\Countries@create');
    Route::get('{CountryWithCounts}', 'Acp\Countries@show');
    Route::put('{Country}', 'Acp\Countries@update');
    Route::delete('{Country}', 'Acp\Countries@destroy');
    Route::get('{Country}/edit', 'Acp\Countries@edit');
});

Route::group(['prefix' => 'dev'], function () {
    Route::get('/', 'Acp\Dev@index');
    Route::get('debugbar', 'Acp\Dev@debugbar');
    Route::get('logs', 'Acp\Dev@logs');
    Route::get('svg', 'Acp\Dev@svg');
    Route::get('templates', 'Acp\Dev\Templates@index');
    Route::get('templates/{template}', 'Acp\Dev\Templates@template');
    Route::get('thumbnails', 'Acp\Dev\Thumbnails@index');
    Route::post('thumbnails', 'Acp\Dev\Thumbnails@thumbnailsPost');
    Route::get('thumbnails/clean', 'Acp\Dev\Thumbnails@clean');
});

Route::group(['prefix' => 'domains'], function () {
    Route::get('/', 'Acp\Domains@index');
    Route::post('/', 'Acp\Domains@store');
    Route::post('batch', 'Acp\Domains@batch');
    Route::get('create', 'Acp\Domains@create');
    Route::get('{Domain}', 'Acp\Domains@show');
    Route::put('{Domain}', 'Acp\Domains@update');
    Route::delete('{Domain}', 'Acp\Domains@destroy');
    Route::get('{Domain}/dkim-secret-key', 'Acp\Domains@dkimSecretKey');
    Route::get('{Domain}/edit', 'Acp\Domains@edit');
    Route::get('{Domain}/mail', 'Acp\Domains@mailboxes');
    Route::post('{Domain}/mail', 'Acp\Domains@addMailbox');
    Route::get('{Domain}/ns-records', 'Acp\Domains@nsRecords');
    Route::post('{Domain}/ns-records', 'Acp\Domains@addNsRecord');
    Route::put('{Domain}/ns-records', 'Acp\Domains@editNsRecord');
    Route::delete('{Domain}/ns-records', 'Acp\Domains@deleteNsRecord');
    Route::get('{Domain}/ns-servers', 'Acp\Domains@nsServers');
    Route::get('{Domain}/robots', 'Acp\Domains@robots');
    Route::post('{Domain}/server-ns', 'Acp\Domains@setServerNsRecords');
    Route::get('{Domain}/yandex-pdd-status', 'Acp\Domains@yandexPddStatus');
    Route::post('{Domain}/yandex-ns', 'Acp\Domains@setYandexNs');
    Route::get('{Domain}/whois', 'Acp\Domains@whois');
});

Route::group(['prefix' => 'files'], function () {
    Route::get('/', 'Acp\Files@index');
    Route::post('/', 'Acp\Files@store');
    Route::get('create', 'Acp\Files@create');
    Route::get('{File}', 'Acp\Files@show');
    Route::put('{File}', 'Acp\Files@update');
    Route::delete('{File}', 'Acp\Files@destroy');
    Route::get('{File}/edit', 'Acp\Files@edit');
});

Route::group(['prefix' => 'gigs'], function () {
    Route::get('/', 'Acp\Gigs@index');
    Route::post('/', 'Acp\Gigs@store');
    Route::get('create', 'Acp\Gigs@create');
    Route::get('{Gig}', 'Acp\Gigs@show');
    Route::put('{Gig}', 'Acp\Gigs@update');
    Route::delete('{Gig}', 'Acp\Gigs@destroy');
    Route::get('{Gig}/edit', 'Acp\Gigs@edit');
});

Route::group(['prefix' => 'images'], function () {
    Route::get('/', 'Acp\Images@index');
    Route::post('batch', 'Acp\Images@batch');
    Route::get('{Image}', 'Acp\Images@show');
    Route::delete('{Image}', 'Acp\Images@destroy');
    Route::get('{Image}/view', 'Acp\Images@view');
});

Route::group(['prefix' => 'metrics'], function () {
    Route::get('/', 'Acp\Metrics@index');
    Route::get('{event}', 'Acp\Metrics@show');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'Acp\News@index');
    Route::post('/', 'Acp\News@store');
    Route::get('create', 'Acp\News@create');
    Route::get('{NewsWithCounts}', 'Acp\News@show');
    Route::put('{News}', 'Acp\News@update');
    Route::delete('{News}', 'Acp\News@destroy');
    Route::get('{News}/edit', 'Acp\News@edit');
    Route::post('{News}/notify', 'Acp\News@notify');
});

Route::group(['prefix' => 'pages'], function () {
    Route::get('/', 'Acp\Pages@index');
    Route::post('/', 'Acp\Pages@store');
    Route::post('batch', 'Acp\Pages@batch');
    Route::get('create', 'Acp\Pages@create');
    Route::post('move', 'Acp\Pages@move');
    Route::get('tree', 'Acp\Pages@tree');
    Route::get('{Page}', 'Acp\Pages@show');
    Route::put('{Page}', 'Acp\Pages@update');
    Route::delete('{Page}', 'Acp\Pages@destroy');
    Route::get('{Page}/edit', 'Acp\Pages@edit');
});

Route::group(['prefix' => 'servers'], function () {
    Route::get('/', 'Acp\Servers@index');
    Route::post('/', 'Acp\Servers@store');
    Route::get('create', 'Acp\Servers@create');
    Route::get('{Server}', 'Acp\Servers@show');
    Route::put('{Server}', 'Acp\Servers@update');
    Route::delete('{Server}', 'Acp\Servers@destroy');
    Route::get('{Server}/edit', 'Acp\Servers@edit');

    Route::group(['prefix' => '{Server}/ftp'], function () {
        Route::get('/', 'Acp\Servers\Ftp@index');
        Route::post('file', 'Acp\Servers\Ftp@filePost');
        Route::post('dir', 'Acp\Servers\Ftp@dirPost');
        Route::get('source', 'Acp\Servers\Ftp@source');
        Route::post('source', 'Acp\Servers\Ftp@sourcePost');
        Route::post('upload', 'Acp\Servers\Ftp@uploadPost');
    });
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('/', 'Acp\Tags@index');
    Route::post('/', 'Acp\Tags@store');
    Route::get('create', 'Acp\Tags@create');
    Route::get('{Tag}', 'Acp\Tags@show');
    Route::put('{Tag}', 'Acp\Tags@update');
    Route::delete('{Tag}', 'Acp\Tags@destroy');
    Route::get('{Tag}/edit', 'Acp\Tags@edit');
});

Route::group(['prefix' => 'torrents'], function () {
    Route::get('/', 'Acp\Torrents@index');
    Route::get('{TorrentWithCounts}', 'Acp\Torrents@show');
    Route::put('{Torrent}', 'Acp\Torrents@update');
    Route::delete('{Torrent}', 'Acp\Torrents@destroy');
    Route::get('{Torrent}/edit', 'Acp\Torrents@edit');
    Route::get('{Torrent}/updateRto', 'Acp\Torrents@updateRto');
});

Route::group(['prefix' => 'trips'], function () {
    Route::get('/', 'Acp\Trips@index');
    Route::post('/', 'Acp\Trips@store');
    Route::get('create', 'Acp\Trips@create');
    Route::get('{Trip}', 'Acp\Trips@show');
    Route::put('{Trip}', 'Acp\Trips@update');
    Route::delete('{Trip}', 'Acp\Trips@destroy');
    Route::get('{Trip}/edit', 'Acp\Trips@edit');
    Route::post('{Trip}/notify', 'Acp\Trips@notify');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Acp\Users@index');
    Route::post('/', 'Acp\Users@store');
    Route::get('create', 'Acp\Users@create');
    Route::get('{UserWithCounts}', 'Acp\Users@show');
    Route::put('{User}', 'Acp\Users@update');
    Route::delete('{User}', 'Acp\Users@destroy');
    Route::get('{User}/edit', 'Acp\Users@edit');
});

Route::group(['prefix' => 'yandex/users'], function () {
    Route::get('/', 'Acp\Yandex\Users@index');
    Route::post('/', 'Acp\Yandex\Users@store');
    Route::get('create', 'Acp\Yandex\Users@create');
    Route::get('{YandexUser}', 'Acp\Yandex\Users@show');
    Route::put('{YandexUser}', 'Acp\Yandex\Users@update');
    Route::delete('{YandexUser}', 'Acp\Yandex\Users@destroy');
    Route::get('{YandexUser}/edit', 'Acp\Yandex\Users@edit');
});
