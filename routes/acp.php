<?php

use App\Http\Controllers\Acp;
use Ivacuum\Generic\Utilities\RouteHelper;

Route::get('/', Acp\HomeController::class);

RouteHelper::crud(Acp\Artists::class);

RouteHelper::withoutCreate(Acp\ChatMessages::class);
Route::post('chat-messages/batch', [Acp\ChatMessages::class, 'batch']);

RouteHelper::crud(Acp\Cities::class);

RouteHelper::crud(Acp\Clients::class);

RouteHelper::withoutCreate(Acp\Comments::class);

RouteHelper::crud(Acp\Countries::class);

RouteHelper::crud(Acp\DcppHubs::class);

Route::get('dev', [Acp\Dev::class, 'index']);
Route::get('dev/debugbar', [Acp\Dev::class, 'debugbar']);
Route::get('dev/logs', [Acp\Dev::class, 'logs']);
Route::get('dev/svg', [Acp\Dev::class, 'svg']);
Route::get('dev/gig-templates', [Acp\Dev\GigTemplates::class, 'index']);
Route::get('dev/gig-templates/{template}', [Acp\Dev\GigTemplates::class, 'show']);
Route::get('dev/templates', [Acp\Dev\Templates::class, 'index']);
Route::get('dev/templates/{template}', [Acp\Dev\Templates::class, 'show']);
Route::get('dev/thumbnails', [Acp\Dev\Thumbnails::class, 'index']);
Route::post('dev/thumbnails', [Acp\Dev\Thumbnails::class, 'store']);
Route::get('dev/thumbnails/clean', [Acp\Dev\Thumbnails::class, 'clean']);

RouteHelper::crud(Acp\Domains::class, null, 'slug');
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

RouteHelper::withoutCreateAndEdit(Acp\ExternalIdentities::class);

RouteHelper::crud(Acp\Files::class);

RouteHelper::crud(Acp\Gigs::class);
Route::post('gigs/{gig}/notify', Acp\GigPublishedNotify::class);

RouteHelper::withoutCreateAndEdit(Acp\Images::class);
Route::post('images/batch', [Acp\Images::class, 'batch']);
Route::get('images/{id}/view', [Acp\Images::class, 'view']);

RouteHelper::withoutCreateAndEdit(Acp\Issues::class);
Route::post('issues/batch', [Acp\Issues::class, 'batch']);
Route::post('issues/{issue}/close', Acp\IssueCloseController::class);
Route::post('issues/{issue}/open', Acp\IssueOpenController::class);

RouteHelper::withoutCreate(Acp\Magnets::class);

Route::get('metrics', [Acp\Metrics::class, 'index']);
Route::get('metrics/{event}', [Acp\Metrics::class, 'show']);

RouteHelper::crud(Acp\News::class);
Route::post('news/{id}/notify', [Acp\News::class, 'notify']);

RouteHelper::withoutCreateAndEdit(Acp\Notifications::class, null, 'uuid');

RouteHelper::crud(Acp\Photos::class);

RouteHelper::crud(Acp\Servers::class);
Route::get('servers/{id}/ftp', [Acp\Servers\Ftp::class, 'index']);
Route::post('servers/{id}/ftp/file', [Acp\Servers\Ftp::class, 'filePost']);
Route::post('servers/{id}/ftp/dir', [Acp\Servers\Ftp::class, 'dirPost']);
Route::get('servers/{id}/ftp/source', [Acp\Servers\Ftp::class, 'source']);
Route::post('servers/{id}/ftp/source', [Acp\Servers\Ftp::class, 'sourcePost']);
Route::post('servers/{id}/ftp/upload', [Acp\Servers\Ftp::class, 'uploadPost']);

RouteHelper::crud(Acp\Tags::class);

RouteHelper::crud(Acp\Trips::class);
Route::get('trips/{trip}/instagram-cover', Acp\TripInstagramCoverController::class);
Route::post('trips/{trip}/notify', Acp\TripPublishedNotify::class);

RouteHelper::crud(Acp\Users::class);

RouteHelper::crud(Acp\YandexUsers::class);
