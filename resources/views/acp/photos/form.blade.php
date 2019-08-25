@if (!$model->exists)
  {!! Form::select('trip_id')->required()->classes(['js-append-formdata'])->values(App\Trip::forInputSelect())->html() !!}

  <div class="mb-4">
    <label>{{ trans('acp.photos.index') }}</label>
    <images-uploader action="{{ path("$self@store") }}" append=".js-append-formdata"></images-uploader>
  </div>
@else
  <div class="mb-6">
    <img class="image-fit-viewport mobile-wide sm:rounded max-w-full" src="{{ $model->originalUrl() }}">
  </div>

  <div class="mb-4">
    <label>Тэги</label>
    @foreach (App\Tag::orderBy(App\Tag::titleField())->get() as $tag)
      <label class="flex items-center font-normal">
        <input class="mr-2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, (array) old('tags', !empty($model) ? $model->tags->pluck('id')->all() : null)) ? 'checked' : '' }}>
        {{ $tag->title }}
      </label>
    @endforeach
    @if ($errors->has('tags'))
      <div class="invalid-feedback block">{{ $errors->first('tags') }}</div>
    @endif
  </div>
@endif
