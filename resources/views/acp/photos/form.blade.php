@if (!$model->exists)
  <div class="form-group">
    <label class="col-md-3 control-label">{{ trans('acp.photos.index') }}:</label>
    <div class="col-md-6">
      <images-uploader action="{{ action("$self@store") }}" append=".js-append-formdata"></images-uploader>
    </div>
  </div>

  @if (Request::has('trip_id'))
    <input class="js-append-formdata" type="hidden" name="trip_id" value="{{ Request::input('trip_id') }}">
  @endif
@else
  <div class="img-container">
    <img src="{{ $model->originalUrl() }}">
  </div>

  <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label">Тэги:</label>
    <div class="col-md-9 checkbox">
      @foreach (App\Tag::orderBy(App\Tag::titleField())->get() as $tag)
        <div>
          <label>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, (array) old('tags', !empty($model) ? $model->tags->pluck('id')->toArray() : null)) ? 'checked' : '' }}>
            {{ $tag->title }}
          </label>
        </div>
      @endforeach
      @include('tpl.input-error', ['input' => 'tags'])
    </div>
  </div>
@endif
