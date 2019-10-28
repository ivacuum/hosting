<?php

use App\Http\Controllers\Acp;
use Ivacuum\Generic\Utilities\RouteHelper;

Route::get('/', [Acp\Home::class, 'index']);

RouteHelper::crud('Acp\Artists');

RouteHelper::withoutCreate('Acp\ChatMessages');
Route::post('chat-messages/batch', [Acp\ChatMessages::class, 'batch']);

RouteHelper::crud('Acp\Cities');
Route::get('cities/geodata', [Acp\Cities::class, 'geodata']);

RouteHelper::crud('Acp\Clients');

RouteHelper::withoutCreate('Acp\Comments');

RouteHelper::crud('Acp\Countries');

RouteHelper::crud('Acp\DcppHubs');

Route::get('dev', [Acp\Dev::class, 'index']);
Route::get('dev/debugbar', [Acp\Dev::class, 'debugbar']);
Route::get('dev/logs', [Acp\Dev::class, 'logs']);
Route::get('dev/svg', [Acp\Dev::class, 'svg']);
Route::get('dev/templates', [Acp\Dev\Templates::class, 'index']);
Route::get('dev/templates/{template}', [Acp\Dev\Templates::class, 'show']);
Route::get('dev/thumbnails', [Acp\Dev\Thumbnails::class, 'index']);
Route::post('dev/thumbnails', [Acp\Dev\Thumbnails::class, 'store']);
Route::get('dev/thumbnails/clean', [Acp\Dev\Thumbnails::class, 'clean']);

RouteHelper::crud('Acp\Domains', null, 'slug');
Route::post('domains/batch', [Acp\Domains::class, 'batch']);
Route::get('domains/{slug}/dkim-secret-key', [Acp\Domains::class, 'dkimSecretKey']);
Route::get('domains/{slug}/mail', [Acp\Domains::class, 'mailboxes']);
Route::post('domains/{slug}/mail', [Acp\Domains::class, 'addMailbox']);
Route::get('domains/{slug}/ns-records', [Acp\Domains::class, 'nsRecords']);
Route::post('domains/{slug}/ns-records', [Acp\Domains::class, 'addNsRecord']);
Route::put('domains/{slug}/ns-records', [Acp\Domains::class, 'editNsRecord']);
Route::delete('domains/{slug}/ns-records', [Acp\Domains::class, 'deleteNsRecord']);
Route::get('domains/{slug}/ns-servers', [Acp\Domains::class, 'nsServers']);
Route::get('domains/{slug}/robots', [Acp\Domains::class, 'robots']);
Route::post('domains/{slug}/server-ns', [Acp\Domains::class, 'setServerNsRecords']);
Route::get('domains/{slug}/yandex-pdd-status', [Acp\Domains::class, 'yandexPddStatus']);
Route::post('domains/{slug}/yandex-ns', [Acp\Domains::class, 'setYandexNs']);
Route::get('domains/{slug}/whois', [Acp\Domains::class, 'whois']);

RouteHelper::withoutCreateAndEdit('Acp\ExternalIdentities');

RouteHelper::crud('Acp\Files');

RouteHelper::crud('Acp\Gigs');
Route::post('gigs/{id}/notify', 'Acp\GigPublishedNotify');

RouteHelper::withoutCreateAndEdit('Acp\Images');
Route::post('images/batch', [Acp\Images::class, 'batch']);
Route::get('images/{id}/view', [Acp\Images::class, 'view']);

RouteHelper::withoutCreateAndEdit('Acp\Issues');
Route::post('issues/batch', [Acp\Issues::class, 'batch']);
Route::post('issues/{id}/close', 'Acp\IssueClose');
Route::post('issues/{id}/comment', 'Acp\IssueComment');
Route::post('issues/{id}/open', 'Acp\IssueOpen');

RouteHelper::withoutCreate('Acp\Kanjis');

Route::get('metrics', [Acp\Metrics::class, 'index']);
Route::get('metrics/{event}', [Acp\Metrics::class, 'show']);

RouteHelper::crud('Acp\News');
Route::post('news/{id}/notify', [Acp\News::class, 'notify']);

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
Route::get('torrents/{id}/updateRto', [Acp\Torrents::class, 'updateRto']);

RouteHelper::crud('Acp\Trips');
Route::post('trips/{id}/notify', 'Acp\TripPublishedNotify');

RouteHelper::crud('Acp\Users');

RouteHelper::withoutCreate('Acp\Vocabularies');

RouteHelper::crud('Acp\YandexUsers');
