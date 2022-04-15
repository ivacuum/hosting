<?php /** @var \App\Gig $model */ ?>

@include('tpl.form_errors')

{!! Form::select('artist_id')->required()->values(resolve(App\Action\ListArtistsForInputSelectAction::class)->execute())->html() !!}
{!! Form::select('city_id')->required()->values(resolve(App\Action\ListCitiesForInputSelectAction::class)->execute())->html() !!}

{!! Form::text('title_ru')->required()->html() !!}
{!! Form::text('title_en')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::text('date')->required()->default(date('Y-m-d'))->html() !!}

{!! Form::radio('status')->required()->values(App\Domain\GigStatus::labels())->html() !!}

{!! Form::text('meta_description_ru')->html() !!}
{!! Form::text('meta_description_en')->html() !!}

{!! Form::text('meta_image')->html() !!}

@if ($model->meta_image)
  <div class="mb-4">
    <img class="max-w-full h-auto rounded" src="{{ $model->meta_image }}" alt="">
  </div>
@endif

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
