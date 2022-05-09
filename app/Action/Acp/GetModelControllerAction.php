<?php namespace App\Action\Acp;

use App\Artist;
use App\ChatMessage;
use App\City;
use App\Client;
use App\Comment;
use App\Country;
use App\DcppHub;
use App\Domain;
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
use App\YandexUser;
use Illuminate\Database\Eloquent\Model;

class GetModelControllerAction
{
    public function execute(Model $model): string
    {
        return match (true) {
            $model instanceof Artist => Controllers\Acp\Artists::class,
            $model instanceof ChatMessage => Controllers\Acp\ChatMessages::class,
            $model instanceof City => Controllers\Acp\Cities::class,
            $model instanceof Client => Controllers\Acp\Clients::class,
            $model instanceof Comment => Controllers\Acp\Comments::class,
            $model instanceof Country => Controllers\Acp\Countries::class,
            $model instanceof DcppHub => Controllers\Acp\DcppHubs::class,
            $model instanceof Domain => Controllers\Acp\Domains::class,
            $model instanceof ExternalIdentity => Controllers\Acp\ExternalIdentities::class,
            $model instanceof File => Controllers\Acp\Files::class,
            $model instanceof Gig => Controllers\Acp\Gigs::class,
            $model instanceof Image => Controllers\Acp\Images::class,
            $model instanceof Issue => Controllers\Acp\Issues::class,
            $model instanceof Magnet => Controllers\Acp\Magnets::class,
            $model instanceof News => Controllers\Acp\NewsController::class,
            $model instanceof Notification => Controllers\Acp\Notifications::class,
            $model instanceof Photo => Controllers\Acp\Photos::class,
            $model instanceof Tag => Controllers\Acp\Tags::class,
            $model instanceof Trip => Controllers\Acp\Trips::class,
            $model instanceof User => Controllers\Acp\Users::class,
            $model instanceof YandexUser => Controllers\Acp\YandexUsers::class,
        };
    }
}
