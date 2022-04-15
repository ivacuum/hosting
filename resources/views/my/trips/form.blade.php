<?php /** @var $model */ ?>
<?php Form::model($model); ?>

{{ ViewHelper::inputHiddenMail() }}

@if ($model->exists)
  {!! Form::text('title_ru')->required()->html() !!}
  {!! Form::text('title_en')->required()->html() !!}
@endif

{!! Form::select('city_id')->required()->values(resolve(App\Action\ListCitiesForInputSelectAction::class)->execute())->html() !!}

{!! Form::text('slug')->required()->placeholder('kaliningrad.2015')->html() !!}

{!! Form::text('date_start')->required()->default(date('Y-m-d'))->html() !!}
{!! Form::text('date_end')->required()->default(date('Y-m-d'))->html() !!}

{!! Form::radio('status')->required()->values(App\Domain\TripStatus::labels())->html() !!}

{!! Form::textarea('markdown')->wide()->html() !!}

@if (!empty($goto))
  <input type="hidden" name="goto" value="{{ $goto }}">
@endif

@csrf
