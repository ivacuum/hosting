@if (!$model->exists)
  {!! Form::select('trip_id')->required()->classes(['js-append-formdata'])->values(App\Trip::forInputSelect())->html() !!}

  <div class="form-group form-row">
    <label class="col-md-4 col-form-label text-md-right">{{ trans('acp.photos.index') }}</label>
    <div class="col-md-6">
      <images-uploader action="{{ path("$self@store") }}" append=".js-append-formdata"></images-uploader>
    </div>
  </div>
@else
  <div class="img-container">
    <img class="image-fit-viewport" src="{{ $model->originalUrl() }}">
  </div>

  <div class="form-group form-row">
    <label class="col-md-4 text-md-right">Тэги</label>
    <div class="col-md-8">
      @foreach (App\Tag::orderBy(App\Tag::titleField())->get() as $tag)
        <label class="form-check">
          <input class="form-check-input {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, (array) old('tags', !empty($model) ? $model->tags->pluck('id')->toArray() : null)) ? 'checked' : '' }}>
          <span class="form-check-label">{{ $tag->title }}</span>
        </label>
      @endforeach
      @if ($errors->has('tags'))
        <div class="invalid-feedback d-block">{{ $errors->first('tags') }}</div>
      @endif
    </div>
  </div>
@endif
