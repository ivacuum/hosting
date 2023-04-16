<?php

use App\Http\Controllers\Acp;

Route::get('/', Acp\HomeController::class);

Route::resource('artists', Acp\ArtistsController::class)->except(['store', 'update']);

Route::resource('chat-messages', Acp\ChatMessagesController::class)->except(['create', 'store', 'update']);
Route::post('chat-messages/batch', [Acp\ChatMessagesController::class, 'batch']);

Route::resource('cities', Acp\CitiesController::class)->except(['store', 'update']);

Route::resource('clients', Acp\ClientsController::class)->except(['store', 'update']);

Route::resource('comments', Acp\CommentsController::class)->except(['create', 'store', 'update']);

Route::resource('countries', Acp\CountriesController::class)->except(['store', 'update']);

Route::resource('dcpp-hubs', Acp\DcppHubsController::class)->except(['store', 'update']);

Route::view('dev', 'acp.dev.index');
Route::get('dev/debugbar', Acp\Dev\EnableDebugBarController::class);
Route::get('dev/logs', [Acp\DevController::class, 'logs']);
Route::get('dev/svg', [Acp\DevController::class, 'svg']);
Route::get('dev/gig-templates', [Acp\Dev\GigTemplatesController::class, 'index']);
Route::get('dev/gig-templates/{template}', [Acp\Dev\GigTemplatesController::class, 'show']);
Route::get('dev/templates', [Acp\Dev\TemplatesController::class, 'index']);
Route::get('dev/templates/{template}', [Acp\Dev\TemplatesController::class, 'show']);
Route::get('dev/thumbnails', [Acp\Dev\ThumbnailsController::class, 'index']);
Route::post('dev/thumbnails', [Acp\Dev\ThumbnailsController::class, 'store']);
Route::get('dev/thumbnails/clean', [Acp\Dev\ThumbnailsController::class, 'clean']);

Route::resource('domains', Acp\DomainsController::class)->except(['store', 'update']);

Route::post('domains/batch', [Acp\DomainsController::class, 'batch']);
Route::get('domains/{domain}/mail', [Acp\DomainsController::class, 'mailboxes']);
Route::post('domains/{domain}/mail', [Acp\DomainsController::class, 'addMailbox']);
Route::get('domains/{domain}/ns-records', [Acp\YandexPddDnsRecordController::class, 'index']);
Route::get('domains/{domain}/ns-records/{id}', [Acp\YandexPddDnsRecordController::class, 'edit']);
Route::delete('domains/{domain}/ns-records/{id}', [Acp\YandexPddDnsRecordController::class, 'destroy']);
Route::get('domains/{domain}/robots', [Acp\DomainsController::class, 'robots']);
Route::get('domains/{domain}/whois', [Acp\DomainsController::class, 'whois']);

Route::resource('emails', Acp\EmailsController::class)->except(['create', 'edit', 'store', 'update']);

Route::resource('external-identities', Acp\ExternalIdentitiesController::class)->except(['create', 'edit', 'store', 'update']);

Route::resource('files', Acp\FilesController::class)->except(['store', 'update']);

Route::resource('gigs', Acp\GigsController::class)->except(['store', 'update']);
Route::post('gigs/{gig}/notify', Acp\GigPublishedNotifyController::class);

Route::resource('images', Acp\ImagesController::class)->except(['create', 'edit', 'store', 'update']);
Route::post('images/batch', [Acp\ImagesController::class, 'batch']);
Route::get('images/{image}/view', [Acp\ImagesController::class, 'view']);

Route::resource('issues', Acp\IssuesController::class)->except(['create', 'edit', 'store', 'update']);
Route::post('issues/batch', [Acp\IssuesController::class, 'batch']);
Route::post('issues/{issue}/close', Acp\IssueCloseController::class);
Route::post('issues/{issue}/open', Acp\IssueOpenController::class);

Route::resource('magnets', Acp\MagnetsController::class)->except(['create', 'store', 'update']);

Route::get('metrics', [Acp\MetricsController::class, 'index'])->can('viewAny', 'App\Metric');
Route::get('metrics/{event}', [Acp\MetricsController::class, 'show'])->can('viewAny', 'App\Metric');

Route::resource('news', Acp\NewsController::class)->except(['store', 'update']);
Route::post('news/{news}/notify', [Acp\NewsController::class, 'notify']);

Route::resource('notifications', Acp\NotificationsController::class)->except(['create', 'edit', 'store', 'update']);

Route::resource('photos', Acp\PhotosController::class)->except(['store', 'update']);

Route::resource('tags', Acp\TagsController::class)->except(['store', 'update']);

Route::resource('trips', Acp\TripsController::class)->except(['store', 'update']);
Route::get('trips/{trip}/instagram-cover', Acp\TripInstagramCoverController::class);
Route::post('trips/{trip}/notify', Acp\TripPublishedNotifyController::class);

Route::resource('users', Acp\UsersController::class)->except(['create', 'store', 'update']);

Route::resource('yandex-users', Acp\YandexUsersController::class)->except(['store', 'update']);
