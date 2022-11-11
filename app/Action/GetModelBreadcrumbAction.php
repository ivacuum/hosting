<?php namespace App\Action;

use App\Artist;
use App\ChatMessage;
use App\City;
use App\Client;
use App\Comment;
use App\Country;
use App\DcppHub;
use App\Domain;
use App\Email;
use App\ExternalHttpRequest;
use App\ExternalIdentity;
use App\FavoriteMovie;
use App\File;
use App\Gig;
use App\Image;
use App\Issue;
use App\Kanji;
use App\Magnet;
use App\Metric;
use App\News;
use App\Notification;
use App\Photo;
use App\Radical;
use App\ReferrerRedirect;
use App\Tag;
use App\Trip;
use App\User;
use App\Vocabulary;
use App\YandexUser;
use Illuminate\Database\Eloquent\Model;

class GetModelBreadcrumbAction
{
    public function execute(Model $model): string
    {
        return match (true) {
            $model instanceof Artist => $model->title,
            $model instanceof ChatMessage => "#{$model->id}",
            $model instanceof City => "{$model->country->emoji} {$model->title}",
            $model instanceof Client => $model->name,
            $model instanceof Comment => "#{$model->id}",
            $model instanceof Country => "{$model->emoji} {$model->title}",
            $model instanceof DcppHub => $model->address,
            $model instanceof Domain => $model->domain,
            $model instanceof Email => "#{$model->id}",
            $model instanceof ExternalHttpRequest => "#{$model->id}",
            $model instanceof ExternalIdentity => $model->email ?: ($model->user_id ? $model->user->email : "#{$model->id}"),
            $model instanceof FavoriteMovie => $model->title_ru,
            $model instanceof File => $model->title,
            $model instanceof Gig => $model->title,
            $model instanceof Image => "#{$model->id}",
            $model instanceof Issue => $model->title,
            $model instanceof Kanji => $model->character,
            $model instanceof Magnet => $model->shortTitle(),
            $model instanceof Metric => $model->event,
            $model instanceof News => $model->title,
            $model instanceof Notification => $model->id,
            $model instanceof Photo => str_replace('/', ' / ', $model->slug),
            $model instanceof Radical => $model->character,
            $model instanceof ReferrerRedirect => $model->to,
            $model instanceof Tag => "#{$model->title}",
            $model instanceof Trip => $model->title,
            $model instanceof User => $model->email ?? '',
            $model instanceof Vocabulary => $model->character,
            $model instanceof YandexUser => $model->account,
        };
    }
}
