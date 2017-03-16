<?php

Route::get('/', 'Acp\Home@index');

Route::group(['prefix' => 'artists'], function () {
    Route::get('/', 'Acp\Artists@index');
    Route::post('/', 'Acp\Artists@store');
    Route::get('create', 'Acp\Artists@create');
    Route::get('{id}', 'Acp\Artists@show');
    Route::put('{id}', 'Acp\Artists@update');
    Route::delete('{id}', 'Acp\Artists@destroy');
    Route::get('{id}/edit', 'Acp\Artists@edit');
});

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', 'Acp\Cities@index');
    Route::post('/', 'Acp\Cities@store');
    Route::get('create', 'Acp\Cities@create');
    Route::get('{id}', 'Acp\Cities@show');
    Route::put('{id}', 'Acp\Cities@update');
    Route::delete('{id}', 'Acp\Cities@destroy');
    Route::get('{id}/edit', 'Acp\Cities@edit');
    Route::get('{id}/geo', 'Acp\Cities@updateGeo');
});

Route::group(['prefix' => 'clients'], function () {
    Route::get('/', 'Acp\Clients@index');
    Route::post('/', 'Acp\Clients@store');
    Route::get('create', 'Acp\Clients@create');
    Route::get('{id}', 'Acp\Clients@show');
    Route::put('{id}', 'Acp\Clients@update');
    Route::delete('{id}', 'Acp\Clients@destroy');
    Route::get('{id}/edit', 'Acp\Clients@edit');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', 'Acp\Comments@index');
    Route::get('{id}', 'Acp\Comments@show');
    Route::put('{id}', 'Acp\Comments@update');
    Route::delete('{id}', 'Acp\Comments@destroy');
    Route::get('{id}/edit', 'Acp\Comments@edit');
});

Route::group(['prefix' => 'countries'], function () {
    Route::get('/', 'Acp\Countries@index');
    Route::post('/', 'Acp\Countries@store');
    Route::get('create', 'Acp\Countries@create');
    Route::get('{id}', 'Acp\Countries@show');
    Route::put('{id}', 'Acp\Countries@update');
    Route::delete('{id}', 'Acp\Countries@destroy');
    Route::get('{id}/edit', 'Acp\Countries@edit');
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
    Route::get('{domain}', 'Acp\Domains@show');
    Route::put('{domain}', 'Acp\Domains@update');
    Route::delete('{domain}', 'Acp\Domains@destroy');
    Route::get('{domain}/dkim-secret-key', 'Acp\Domains@dkimSecretKey');
    Route::get('{domain}/edit', 'Acp\Domains@edit');
    Route::get('{domain}/mail', 'Acp\Domains@mailboxes');
    Route::post('{domain}/mail', 'Acp\Domains@addMailbox');
    Route::get('{domain}/ns-records', 'Acp\Domains@nsRecords');
    Route::post('{domain}/ns-records', 'Acp\Domains@addNsRecord');
    Route::put('{domain}/ns-records', 'Acp\Domains@editNsRecord');
    Route::delete('{domain}/ns-records', 'Acp\Domains@deleteNsRecord');
    Route::get('{domain}/ns-servers', 'Acp\Domains@nsServers');
    Route::get('{domain}/robots', 'Acp\Domains@robots');
    Route::post('{domain}/server-ns', 'Acp\Domains@setServerNsRecords');
    Route::get('{domain}/yandex-pdd-status', 'Acp\Domains@yandexPddStatus');
    Route::post('{domain}/yandex-ns', 'Acp\Domains@setYandexNs');
    Route::get('{domain}/whois', 'Acp\Domains@whois');
});

Route::group(['prefix' => 'files'], function () {
    Route::get('/', 'Acp\Files@index');
    Route::post('/', 'Acp\Files@store');
    Route::get('create', 'Acp\Files@create');
    Route::get('{id}', 'Acp\Files@show');
    Route::put('{id}', 'Acp\Files@update');
    Route::delete('{id}', 'Acp\Files@destroy');
    Route::get('{id}/edit', 'Acp\Files@edit');
});

Route::group(['prefix' => 'gigs'], function () {
    Route::get('/', 'Acp\Gigs@index');
    Route::post('/', 'Acp\Gigs@store');
    Route::get('create', 'Acp\Gigs@create');
    Route::get('{id}', 'Acp\Gigs@show');
    Route::put('{id}', 'Acp\Gigs@update');
    Route::delete('{id}', 'Acp\Gigs@destroy');
    Route::get('{id}/edit', 'Acp\Gigs@edit');
});

Route::group(['prefix' => 'images'], function () {
    Route::get('/', 'Acp\Images@index');
    Route::post('batch', 'Acp\Images@batch');
    Route::get('{id}', 'Acp\Images@show');
    Route::delete('{id}', 'Acp\Images@destroy');
    Route::get('{id}/view', 'Acp\Images@view');
});

Route::group(['prefix' => 'metrics'], function () {
    Route::get('/', 'Acp\Metrics@index');
    Route::get('{event}', 'Acp\Metrics@show');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'Acp\News@index');
    Route::post('/', 'Acp\News@store');
    Route::get('create', 'Acp\News@create');
    Route::get('{id}', 'Acp\News@show');
    Route::put('{id}', 'Acp\News@update');
    Route::delete('{id}', 'Acp\News@destroy');
    Route::get('{id}/edit', 'Acp\News@edit');
    Route::post('{id}/notify', 'Acp\News@notify');
});

Route::group(['prefix' => 'pages'], function () {
    Route::get('/', 'Acp\Pages@index');
    Route::post('/', 'Acp\Pages@store');
    Route::post('batch', 'Acp\Pages@batch');
    Route::get('create', 'Acp\Pages@create');
    Route::post('move', 'Acp\Pages@move');
    Route::get('tree', 'Acp\Pages@tree');
    Route::get('{id}', 'Acp\Pages@show');
    Route::put('{id}', 'Acp\Pages@update');
    Route::delete('{id}', 'Acp\Pages@destroy');
    Route::get('{id}/edit', 'Acp\Pages@edit');
});

Route::group(['prefix' => 'photos'], function () {
    Route::get('/', 'Acp\Photos@index');
    Route::post('/', 'Acp\Photos@store');
    Route::get('create', 'Acp\Photos@create');
    Route::get('{id}', 'Acp\Photos@show');
    Route::put('{id}', 'Acp\Photos@update');
    Route::delete('{id}', 'Acp\Photos@destroy');
    Route::get('{id}/edit', 'Acp\Photos@edit');
});

Route::group(['prefix' => 'servers'], function () {
    Route::get('/', 'Acp\Servers@index');
    Route::post('/', 'Acp\Servers@store');
    Route::get('create', 'Acp\Servers@create');
    Route::get('{id}', 'Acp\Servers@show');
    Route::put('{id}', 'Acp\Servers@update');
    Route::delete('{id}', 'Acp\Servers@destroy');
    Route::get('{id}/edit', 'Acp\Servers@edit');

    Route::group(['prefix' => '{id}/ftp'], function () {
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
    Route::get('{id}', 'Acp\Tags@show');
    Route::put('{id}', 'Acp\Tags@update');
    Route::delete('{id}', 'Acp\Tags@destroy');
    Route::get('{id}/edit', 'Acp\Tags@edit');
});

Route::group(['prefix' => 'torrents'], function () {
    Route::get('/', 'Acp\Torrents@index');
    Route::get('{id}', 'Acp\Torrents@show');
    Route::put('{id}', 'Acp\Torrents@update');
    Route::delete('{id}', 'Acp\Torrents@destroy');
    Route::get('{id}/edit', 'Acp\Torrents@edit');
    Route::get('{id}/updateRto', 'Acp\Torrents@updateRto');
});

Route::group(['prefix' => 'trips'], function () {
    Route::get('/', 'Acp\Trips@index');
    Route::post('/', 'Acp\Trips@store');
    Route::get('create', 'Acp\Trips@create');
    Route::get('{id}', 'Acp\Trips@show');
    Route::put('{id}', 'Acp\Trips@update');
    Route::delete('{id}', 'Acp\Trips@destroy');
    Route::get('{id}/edit', 'Acp\Trips@edit');
    Route::post('{id}/notify', 'Acp\Trips@notify');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Acp\Users@index');
    Route::post('/', 'Acp\Users@store');
    Route::get('create', 'Acp\Users@create');
    Route::get('{id}', 'Acp\Users@show');
    Route::put('{id}', 'Acp\Users@update');
    Route::delete('{id}', 'Acp\Users@destroy');
    Route::get('{id}/edit', 'Acp\Users@edit');
});

Route::group(['prefix' => 'yandex-users'], function () {
    Route::get('/', 'Acp\YandexUsers@index');
    Route::post('/', 'Acp\YandexUsers@store');
    Route::get('create', 'Acp\YandexUsers@create');
    Route::get('{id}', 'Acp\YandexUsers@show');
    Route::put('{id}', 'Acp\YandexUsers@update');
    Route::delete('{id}', 'Acp\YandexUsers@destroy');
    Route::get('{id}/edit', 'Acp\YandexUsers@edit');
});
