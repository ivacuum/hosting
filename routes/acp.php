<?php

use Ivacuum\Generic\Utilities\RouteHelper;

Route::get('/', 'Acp\Home@index');

RouteHelper::crud('Acp\Artists');

RouteHelper::withoutCreate('Acp\ChatMessages');
Route::post('chat-messages/batch', 'Acp\ChatMessages@batch');

RouteHelper::crud('Acp\Cities');
Route::get('cities/geodata', 'Acp\Cities@geodata');

RouteHelper::crud('Acp\Clients');

RouteHelper::withoutCreate('Acp\Comments');

RouteHelper::crud('Acp\Countries');

RouteHelper::crud('Acp\DcppHubs');

Route::get('dev', 'Acp\Dev@index');
Route::get('dev/debugbar', 'Acp\Dev@debugbar');
Route::get('dev/logs', 'Acp\Dev@logs');
Route::get('dev/svg', 'Acp\Dev@svg');
Route::get('dev/templates', 'Acp\Dev\Templates@index');
Route::get('dev/templates/{template}', 'Acp\Dev\Templates@show');
Route::get('dev/thumbnails', 'Acp\Dev\Thumbnails@index');
Route::post('dev/thumbnails', 'Acp\Dev\Thumbnails@thumbnailsPost');
Route::get('dev/thumbnails/clean', 'Acp\Dev\Thumbnails@clean');

RouteHelper::crud('Acp\Domains', null, 'slug');
Route::post('domains/batch', 'Acp\Domains@batch');
Route::get('domains/{slug}/dkim-secret-key', 'Acp\Domains@dkimSecretKey');
Route::get('domains/{slug}/mail', 'Acp\Domains@mailboxes');
Route::post('domains/{slug}/mail', 'Acp\Domains@addMailbox');
Route::get('domains/{slug}/ns-records', 'Acp\Domains@nsRecords');
Route::post('domains/{slug}/ns-records', 'Acp\Domains@addNsRecord');
Route::put('domains/{slug}/ns-records', 'Acp\Domains@editNsRecord');
Route::delete('domains/{slug}/ns-records', 'Acp\Domains@deleteNsRecord');
Route::get('domains/{slug}/ns-servers', 'Acp\Domains@nsServers');
Route::get('domains/{slug}/robots', 'Acp\Domains@robots');
Route::post('domains/{slug}/server-ns', 'Acp\Domains@setServerNsRecords');
Route::get('domains/{slug}/yandex-pdd-status', 'Acp\Domains@yandexPddStatus');
Route::post('domains/{slug}/yandex-ns', 'Acp\Domains@setYandexNs');
Route::get('domains/{slug}/whois', 'Acp\Domains@whois');

RouteHelper::withoutCreateAndEdit('Acp\ExternalIdentities');

RouteHelper::crud('Acp\Files');

RouteHelper::crud('Acp\Gigs');
Route::post('gigs/{id}/notify', 'Acp\GigPublishedNotify');

RouteHelper::withoutCreateAndEdit('Acp\Images');
Route::post('images/batch', 'Acp\Images@batch');
Route::get('images/{id}/view', 'Acp\Images@view');

RouteHelper::withoutCreateAndEdit('Acp\Issues');
Route::post('issues/batch', 'Acp\Issues@batch');
Route::post('issues/{id}/close', 'Acp\IssueClose');
Route::post('issues/{id}/comment', 'Acp\IssueComment');
Route::post('issues/{id}/open', 'Acp\IssueOpen');

RouteHelper::withoutCreate('Acp\Kanjis');

Route::get('metrics', 'Acp\Metrics@index');
Route::get('metrics/{event}', 'Acp\Metrics@show');

RouteHelper::crud('Acp\News');
Route::post('news/{id}/notify', 'Acp\News@notify');

RouteHelper::withoutCreateAndEdit('Acp\Notifications', null, 'uuid');

RouteHelper::crud('Acp\Pages');
Route::post('pages/batch', 'Acp\Pages@batch');
Route::post('pages/move', 'Acp\Pages@move');
Route::get('pages/tree', 'Acp\Pages@tree');

RouteHelper::crud('Acp\Photos');

RouteHelper::withoutCreate('Acp\Radicals');

RouteHelper::crud('Acp\Servers');
Route::get('servers/{id}/ftp', 'Acp\Servers\Ftp@index');
Route::post('servers/{id}/ftp/file', 'Acp\Servers\Ftp@filePost');
Route::post('servers/{id}/ftp/dir', 'Acp\Servers\Ftp@dirPost');
Route::get('servers/{id}/ftp/source', 'Acp\Servers\Ftp@source');
Route::post('servers/{id}/ftp/source', 'Acp\Servers\Ftp@sourcePost');
Route::post('servers/{id}/ftp/upload', 'Acp\Servers\Ftp@uploadPost');

RouteHelper::crud('Acp\Tags');

RouteHelper::withoutCreate('Acp\Torrents');
Route::get('torrents/{id}/updateRto', 'Acp\Torrents@updateRto');

RouteHelper::crud('Acp\Trips');
Route::post('trips/{id}/notify', 'Acp\TripPublishedNotify');

RouteHelper::crud('Acp\Users');

RouteHelper::withoutCreate('Acp\Vocabularies');

RouteHelper::crud('Acp\YandexUsers');
