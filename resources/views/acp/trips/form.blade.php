@include('tpl.form_errors')

@if ($model->exists)
  {!! Form::text('title_ru')->required()->html() !!}
  {!! Form::text('title_en')->required()->html() !!}
@endif

{!! Form::select('city_id')->required()->values(App\City::forInputSelect())->html() !!}

{!! Form::text('slug')->required()->html() !!}

{!! Form::text('date_start')->required()->default(date('Y-m-d'))->html() !!}
{!! Form::text('date_end')->required()->default(date('Y-m-d'))->html() !!}

{!! Form::radio('status')->required()->values([
  App\Trip::STATUS_HIDDEN => 'Скрыта',
  App\Trip::STATUS_INACTIVE => 'Неактивна',
  App\Trip::STATUS_PUBLISHED => 'Опубликована',
])->html() !!}

{!! Form::text('meta_description_ru')->html() !!}
{!! Form::text('meta_description_en')->html() !!}

{!! Form::text('meta_image')->html() !!}

@if ($model->meta_image)
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <img class="img-responsive img-rounded" src="{{ $model->metaImage() }}">
    </div>
  </div>
@endif
