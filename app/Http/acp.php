<?php

// Admin control panel
Route::group(['namespace' => 'Acp', 'prefix' => 'acp', 'breadcrumbs' => [['Админка', 'acp']], 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'Home@index');

    Route::group(['prefix' => 'clients', 'breadcrumbs' => [['Клиенты', 'acp/clients']]], function() {
        Route::get('/', 'Clients@index');
        Route::post('/', 'Clients@store');
        Route::get('create', 'Clients@create');
        Route::get('{Client}', 'Clients@show');
        Route::put('{Client}', 'Clients@update');
        Route::patch('{Client}', 'Clients@update');
        Route::delete('{Client}', 'Clients@destroy');
        Route::get('{Client}/edit', 'Clients@edit');
    });

    Route::group(['prefix' => 'domains', 'breadcrumbs' => [['Домены', 'acp/domains']]], function() {
        Route::get('/', 'Domains@index');
        Route::post('/', 'Domains@store');
        Route::post('batch', 'Domains@batch');
        Route::get('create', 'Domains@create');
        Route::get('{Domain}', 'Domains@show');
        Route::put('{Domain}', 'Domains@update');
        Route::patch('{Domain}', 'Domains@update');
        Route::delete('{Domain}', 'Domains@destroy');
        Route::get('{Domain}/edit', 'Domains@edit');
        Route::get('{Domain}/mail', 'Domains@mailboxes');
        Route::post('{Domain}/mail', 'Domains@addMailbox');
        Route::get('{Domain}/ns-records', 'Domains@nsRecords');
        Route::post('{Domain}/ns-records', 'Domains@addNsRecord');
        Route::put('{Domain}/ns-records', 'Domains@editNsRecord');
        Route::delete('{Domain}/ns-records', 'Domains@deleteNsRecord');
        Route::get('{Domain}/ns-servers', 'Domains@nsServers');
        Route::get('{Domain}/robots', 'Domains@robots');
        Route::post('{Domain}/server-ns', 'Domains@setServerNsRecords');
        Route::get('{Domain}/yandex-pdd-status', 'Domains@yandexPddStatus');
        Route::post('{Domain}/yandex-ns', 'Domains@setYandexNs');
        Route::get('{Domain}/whois', 'Domains@whois');
    });

    Route::group(['prefix' => 'pages', 'breadcrumbs' => [['Страницы', 'acp/pages']]], function() {
        Route::get('/', 'Pages@index');
        Route::post('/', 'Pages@store');
        Route::post('batch', 'Pages@batch');
        Route::get('create', 'Pages@create');
        Route::post('move', 'Pages@move');
        Route::get('tree', 'Pages@tree');
        Route::get('{Page}', 'Pages@show');
        Route::put('{Page}', 'Pages@update');
        Route::patch('{Page}', 'Pages@update');
        Route::delete('{Page}', 'Pages@destroy');
        Route::get('{Page}/edit', 'Pages@edit');
    });

    Route::group(['prefix' => 'servers', 'breadcrumbs' => [['Серверы', 'acp/servers']]], function() {
        Route::get('/', 'Servers@index');
        Route::post('/', 'Servers@store');
        Route::get('create', 'Servers@create');
        Route::get('{Server}', 'Servers@show');
        Route::put('{Server}', 'Servers@update');
        Route::patch('{Server}', 'Servers@update');
        Route::delete('{Server}', 'Servers@destroy');
        Route::get('{Server}/edit', 'Servers@edit');

        Route::group(['namespace' => 'Servers', 'prefix' => '{Server}/ftp'], function() {
            Route::get('/', 'Ftp@index');
            Route::post('file', 'Ftp@filePost');
            Route::post('dir', 'Ftp@dirPost');
            Route::get('source', 'Ftp@source');
            Route::post('source', 'Ftp@sourcePost');
            Route::post('upload', 'Ftp@uploadPost');
        });
    });

    Route::group(['prefix' => 'users', 'breadcrumbs' => [['Пользователи', 'acp/users']]], function() {
        Route::get('/', 'Users@index');
        Route::post('/', 'Users@store');
        Route::get('create', 'Users@create');
        Route::get('{User}', 'Users@show');
        Route::put('{User}', 'Users@update');
        Route::patch('{User}', 'Users@update');
        Route::delete('{User}', 'Users@destroy');
        Route::get('{User}/edit', 'Users@edit');
    });

    Route::group(['namespace' => 'Yandex', 'prefix' => 'yandex/users', 'breadcrumbs' => [['Пользователи Яндекс API', 'acp/yandex/users']]], function() {
        Route::get('/', 'Users@index');
        Route::post('/', 'Users@store');
        Route::get('create', 'Users@create');
        Route::get('{YandexUser}', 'Users@show');
        Route::put('{YandexUser}', 'Users@update');
        Route::patch('{YandexUser}', 'Users@update');
        Route::delete('{YandexUser}', 'Users@destroy');
        Route::get('{YandexUser}/edit', 'Users@edit');
    });
});
