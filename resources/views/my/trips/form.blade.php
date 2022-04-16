<?php /** @var $model */ ?>
<?php Form::model($model); ?>

{{ ViewHelper::inputHiddenMail() }}

@if ($model->exists)
  {{ Form::text('title_ru')->required() }}
  {{ Form::text('title_en')->required() }}
@endif

{{ Form::select('city_id')->required()->values(resolve(App\Action\ListCitiesForInputSelectAction::class)->execute()) }}

{{ Form::text('slug')->required()->placeholder('kaliningrad.2015') }}

{{ Form::text('date_start')->required()->default(date('Y-m-d')) }}
{{ Form::text('date_end')->required()->default(date('Y-m-d')) }}

{{ Form::radio('status')->required()->values(App\Domain\TripStatus::labels()) }}

{{ Form::textarea('markdown')->wide() }}

@if (!empty($goto))
  <input type="hidden" name="goto" value="{{ $goto }}">
@endif

@csrf
