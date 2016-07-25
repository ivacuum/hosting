<?php

// Admin control panel
Route::get('/', 'Acp\Home@index');

Route::group(['prefix' => 'cities', 'breadcrumbs' => [['Города', 'acp/cities']]], function() {
    Route::get('/', 'Acp\Cities@index');
    Route::post('/', 'Acp\Cities@store');
    Route::get('create', 'Acp\Cities@create');
    Route::get('{City}', 'Acp\Cities@show');
    Route::put('{City}', 'Acp\Cities@update');
    Route::delete('{City}', 'Acp\Cities@destroy');
    Route::get('{City}/edit', 'Acp\Cities@edit');
});

Route::group(['prefix' => 'clients', 'breadcrumbs' => [['Клиенты', 'acp/clients']]], function() {
    Route::get('/', 'Acp\Clients@index');
    Route::post('/', 'Acp\Clients@store');
    Route::get('create', 'Acp\Clients@create');
    Route::get('{Client}', 'Acp\Clients@show');
    Route::put('{Client}', 'Acp\Clients@update');
    Route::delete('{Client}', 'Acp\Clients@destroy');
    Route::get('{Client}/edit', 'Acp\Clients@edit');
});

Route::group(['prefix' => 'countries', 'breadcrumbs' => [['Страны', 'acp/countries']]], function() {
    Route::get('/', 'Acp\Countries@index');
    Route::post('/', 'Acp\Countries@store');
    Route::get('create', 'Acp\Countries@create');
    Route::get('{Country}', 'Acp\Countries@show');
    Route::put('{Country}', 'Acp\Countries@update');
    Route::delete('{Country}', 'Acp\Countries@destroy');
    Route::get('{Country}/edit', 'Acp\Countries@edit');
});

Route::group(['prefix' => 'dev', 'breadcrumbs' => [['Разработка', 'acp/dev']]], function () {
    Route::get('/', 'Acp\Dev@index');
    Route::get('debugbar', 'Acp\Dev@debugbar');
    Route::get('svg', 'Acp\Dev@svg');
    Route::get('templates', 'Acp\Dev@templates');
    Route::get('templates/{template}', 'Acp\Dev@template');
    Route::get('thumbnails', 'Acp\Dev@thumbnails');
    Route::post('thumbnails', 'Acp\Dev@thumbnailsPost');
});

Route::group(['prefix' => 'domains', 'breadcrumbs' => [['Домены', 'acp/domains']]], function() {
    Route::get('/', 'Acp\Domains@index');
    Route::post('/', 'Acp\Domains@store');
    Route::post('batch', 'Acp\Domains@batch');
    Route::get('create', 'Acp\Domains@create');
    Route::get('{Domain}', 'Acp\Domains@show');
    Route::put('{Domain}', 'Acp\Domains@update');
    Route::delete('{Domain}', 'Acp\Domains@destroy');
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

Route::group(['prefix' => 'pages', 'breadcrumbs' => [['Страницы', 'acp/pages']]], function() {
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

Route::group(['prefix' => 'servers', 'breadcrumbs' => [['Серверы', 'acp/servers']]], function() {
    Route::get('/', 'Acp\Servers@index');
    Route::post('/', 'Acp\Servers@store');
    Route::get('create', 'Acp\Servers@create');
    Route::get('{Server}', 'Acp\Servers@show');
    Route::put('{Server}', 'Acp\Servers@update');
    Route::delete('{Server}', 'Acp\Servers@destroy');
    Route::get('{Server}/edit', 'Acp\Servers@edit');

    Route::group(['prefix' => '{Server}/ftp'], function() {
        Route::get('/', 'Acp\Servers\Ftp@index');
        Route::post('file', 'Acp\Servers\Ftp@filePost');
        Route::post('dir', 'Acp\Servers\Ftp@dirPost');
        Route::get('source', 'Acp\Servers\Ftp@source');
        Route::post('source', 'Acp\Servers\Ftp@sourcePost');
        Route::post('upload', 'Acp\Servers\Ftp@uploadPost');
    });
});

Route::group(['prefix' => 'trips', 'breadcrumbs' => [['Поездки', 'acp/trips']]], function() {
    Route::get('/', 'Acp\Trips@index');
    Route::post('/', 'Acp\Trips@store');
    Route::get('create', 'Acp\Trips@create');
    Route::get('{Trip}', 'Acp\Trips@show');
    Route::put('{Trip}', 'Acp\Trips@update');
    Route::delete('{Trip}', 'Acp\Trips@destroy');
    Route::get('{Trip}/edit', 'Acp\Trips@edit');
});

Route::group(['prefix' => 'users', 'breadcrumbs' => [['Пользователи', 'acp/users']]], function() {
    Route::get('/', 'Acp\Users@index');
    Route::post('/', 'Acp\Users@store');
    Route::get('create', 'Acp\Users@create');
    Route::get('{User}', 'Acp\Users@show');
    Route::put('{User}', 'Acp\Users@update');
    Route::delete('{User}', 'Acp\Users@destroy');
    Route::get('{User}/edit', 'Acp\Users@edit');
});

Route::group(['prefix' => 'yandex/users', 'breadcrumbs' => [['Пользователи Яндекс API', 'acp/yandex/users']]], function() {
    Route::get('/', 'Acp\Yandex\Users@index');
    Route::post('/', 'Acp\Yandex\Users@store');
    Route::get('create', 'Acp\Yandex\Users@create');
    Route::get('{YandexUser}', 'Acp\Yandex\Users@show');
    Route::put('{YandexUser}', 'Acp\Yandex\Users@update');
    Route::delete('{YandexUser}', 'Acp\Yandex\Users@destroy');
    Route::get('{YandexUser}/edit', 'Acp\Yandex\Users@edit');
});
