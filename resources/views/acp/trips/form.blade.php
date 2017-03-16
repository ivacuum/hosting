@include('tpl.form_errors')

@if ($model->exists)
  <div class="form-group {{ $errors->has('title_ru') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label required">Название:</label>
    <div class="col-md-6">
      <input required type="text" class="form-control" name="title_ru" value="{{ old('title_ru', @$model->title_ru) }}">
    </div>
  </div>

  <div class="form-group {{ $errors->has('title_en') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label required">Название EN:</label>
    <div class="col-md-6">
      <input required type="text" class="form-control" name="title_en" value="{{ old('title_en', @$model->title_en) }}">
    </div>
  </div>
@endif

<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Город:</label>
  <div class="col-md-6">
    <div class="form-select">
      <select class="form-control" name="city_id">
        <option value="0">—</option>
        @foreach (App\City::orderBy("title_{$locale}")->get() as $row)
          <option value="{{ $row->id }}" {{ $row->id == old('city_id', @$model->city_id) ? 'selected' : '' }}>
            {{ $row->title }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">URL:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="slug" value="{{ old('slug', @$model->slug) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('date_start') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Дата начала:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="date_start" value="{{ old('date_start', $model->date_start ?? date('Y-m-d')) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('date_end') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Дата окончания:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="date_end" value="{{ old('date_end', $model->date_end ?? date('Y-m-d')) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Статус:</label>
  <div class="col-md-6">
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\Trip::STATUS_HIDDEN }}" {{ App\Trip::STATUS_HIDDEN == old('status', @$model->status) ? 'checked' : '' }}>
        <span class="text-muted">Скрыта</span>
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\Trip::STATUS_INACTIVE }}" {{ App\Trip::STATUS_INACTIVE == old('status', @$model->status) ? 'checked' : '' }}>
        Неактивна
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\Trip::STATUS_PUBLISHED }}" {{ App\Trip::STATUS_PUBLISHED == old('status', @$model->status) ? 'checked' : '' }}>
        <span class="text-success">Опубликована</span>
      </label>
    </div>
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
    @if (@$model->meta_image)
      <div class="mt-3">
        <img class="img-responsive img-rounded" src="{{ $model->metaImage() }}">
      </div>
    @endif
  </div>
</div>

