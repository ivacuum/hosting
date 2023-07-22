<?php

namespace App\Action\Acp;

use App\Artist;
use App\ChatMessage;
use App\City;
use App\Comment;
use App\Country;
use App\DcppHub;
use App\Email;
use App\ExternalIdentity;
use App\File;
use App\Gig;
use App\Http\Controllers;
use App\Image;
use App\Issue;
use App\Magnet;
use App\News;
use App\Notification;
use App\Photo;
use App\Tag;
use App\Trip;
use App\User;
use Illuminate\Database\Eloquent\Model;

class GetModelControllerAction
{
    public function execute(Model $model): string
    {
        return match (true) {
            $model instanceof Artist => Controllers\Acp\ArtistsController::class,
            $model instanceof ChatMessage => Controllers\Acp\ChatMessagesController::class,
            $model instanceof City => Controllers\Acp\CitiesController::class,
            $model instanceof Comment => Controllers\Acp\CommentsController::class,
            $model instanceof Country => Controllers\Acp\CountriesController::class,
            $model instanceof DcppHub => Controllers\Acp\DcppHubsController::class,
            $model instanceof Email => Controllers\Acp\EmailsController::class,
            $model instanceof ExternalIdentity => Controllers\Acp\ExternalIdentitiesController::class,
            $model instanceof File => Controllers\Acp\FilesController::class,
            $model instanceof Gig => Controllers\Acp\GigsController::class,
            $model instanceof Image => Controllers\Acp\ImagesController::class,
            $model instanceof Issue => Controllers\Acp\IssuesController::class,
            $model instanceof Magnet => Controllers\Acp\MagnetsController::class,
            $model instanceof News => Controllers\Acp\NewsController::class,
            $model instanceof Notification => Controllers\Acp\NotificationsController::class,
            $model instanceof Photo => Controllers\Acp\PhotosController::class,
            $model instanceof Tag => Controllers\Acp\TagsController::class,
            $model instanceof Trip => Controllers\Acp\TripsController::class,
            $model instanceof User => Controllers\Acp\UsersController::class,
            default => throw new \InvalidArgumentException($model->toJson()),
        };
    }
}
