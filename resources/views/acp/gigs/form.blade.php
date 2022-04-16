<?php
/** @var \App\Gig $model */

$artistIds = resolve(App\Action\ListArtistsForInputSelectAction::class)->execute();
$cityIds = resolve(App\Action\ListCitiesForInputSelectAction::class)->execute();
?>

@include('tpl.form_errors')

{{ Form::select('artist_id')->required()->values($artistIds) }}
{{ Form::select('city_id')->required()->values($cityIds) }}

{{ Form::text('title_ru')->required() }}
{{ Form::text('title_en')->required() }}
{{ Form::text('slug')->required() }}
{{ Form::text('date')->required()->default(date('Y-m-d')) }}

{{ Form::radio('status')->required()->values(App\Domain\GigStatus::labels()) }}

{{ Form::text('meta_description_ru') }}
{{ Form::text('meta_description_en') }}

{{ Form::text('meta_image') }}

@if ($model->meta_image)
  <div class="mb-4">
    <img class="max-w-full h-auto rounded" src="{{ $model->meta_image }}" alt="">
  </div>
@endif

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
