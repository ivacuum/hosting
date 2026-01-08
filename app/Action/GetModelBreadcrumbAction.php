<?php

namespace App\Action;

use App\ChatMessage;
use App\Comment;
use App\Domain\Dcpp\Models\DcppHub;
use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Country;
use App\Domain\Life\Models\Gig;
use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Tag;
use App\Domain\Life\Models\Trip;
use App\Domain\Log\Models\ExternalHttpRequest;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Metrics\Models\Metric;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Models\Vocabulary;
use App\Email;
use App\ExternalIdentity;
use App\FavoriteMovie;
use App\File;
use App\Image;
use App\Issue;
use App\News;
use App\User;
use Illuminate\Database\Eloquent\Model;

class GetModelBreadcrumbAction
{
    public function execute(Model $model): string
    {
        return match (true) {
            $model instanceof Artist => $model->title,
            $model instanceof ChatMessage => "#{$model->id}",
            $model instanceof City => "{$model->country->emoji} {$model->title}",
            $model instanceof Comment => "#{$model->id}",
            $model instanceof Country => "{$model->emoji} {$model->title}",
            $model instanceof DcppHub => $model->address,
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
            $model instanceof Photo => str_replace('/', ' / ', $model->slug),
            $model instanceof Radical => $model->character,
            $model instanceof SocialMediaPost => "#{$model->id}",
            $model instanceof Tag => "#{$model->title}",
            $model instanceof Trip => $model->title,
            $model instanceof User => $model->email ?? '',
            $model instanceof Vocabulary => $model->character,
        };
    }
}
