@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Название:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$model->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">URL:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="slug" value="{{ old('slug', @$model->slug) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Город:</label>
  <div class="col-md-6">
    <div class="form-select">
      <select class="form-control" name="city_id">
        <option value="0">—</option>
        @foreach (App\City::orderBy('title_ru')->get(['id', 'title_ru']) as $row)
          <option value="{{ $row->id }}" {{ $row->id == old('city_id', @$model->city_id) ? 'selected' : '' }}>
            {{ $row->title_ru }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="form-group {{ $errors->has('tpl') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label">Шаблон:</label>
  <div class="col-md-6">
    <div class="form-select">
      <select class="form-control" name="tpl">
        <option value="0">—</option>
        @foreach ($templates as $template)
          <option value="{{ $template }}" {{ $template == old('tpl', @$model->tpl) ? 'selected' : '' }}>
            {{ $template }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Дата:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="date" value="{{ old('date', @$model->date) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('venue_ru') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label">Площадка:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="venue_ru" value="{{ old('venue_ru', @$model->venue_ru) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('venue_en') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label">Площадка EN:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="venue_en" value="{{ old('venue_en', @$model->venue_en) }}">
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-3 checkbox">
    <input type="hidden" name="status" value="0">
    <label>
      <input type="checkbox" name="status" value="{{ App\Gig::STATUS_PUBLISHED }}" {{ App\Gig::STATUS_PUBLISHED == old('status', @$model->status) ? 'checked' : '' }}>
      Опубликован
    </label>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Meta description:</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="meta_description_ru" value="{{ old('meta_description_ru', @$model->meta_description_ru) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Meta description EN:</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="meta_description_en" value="{{ old('meta_description_en', @$model->meta_description_en) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Meta image:</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="meta_image" value="{{ old('meta_image', @$model->meta_image) }}">
    @if ($meta_image = old('meta_image', @$model->meta_image))
      <div class="m-t-1">
        <img class="img-responsive img-rounded" src="{{ $meta_image }}">
      </div>
    @endif
  </div>
</div>

