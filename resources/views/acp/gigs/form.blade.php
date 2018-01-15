@include('tpl.form_errors')

{!! Form::text('title_ru')->required()->html() !!}
{!! Form::text('title_en')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::select('city_id')->required()->values(App\City::forInputSelect())->html() !!}
{!! Form::select('artist_id')->required()->values(App\Artist::forInputSelect())->html() !!}
{!! Form::text('date')->required()->default(date('Y-m-d'))->html() !!}

{!! Form::checkbox('status')
  ->default(App\Gig::STATUS_HIDDEN)
  ->values([App\Gig::STATUS_PUBLISHED => 'Опубликован'])
  ->html() !!}

{!! Form::text('meta_description_ru')->html() !!}
{!! Form::text('meta_description_en')->html() !!}
{!! Form::text('meta_image')->html() !!}

@if ($meta_image = old('meta_image', @$model->meta_image))
  <div class="form-group form-row">
    <div class="col-md-6 offset-md-4">
      <img class="img-fluid rounded" src="{{ $meta_image }}">
    </div>
  </div>
@endif

