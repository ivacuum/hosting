@include('tpl.form_errors')

<div class="form-group {{ $errors->has('site_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Сайт:</label>
  <div class="col-md-6">
    <div class="form-select">
      <select class="form-control" name="site_id">
        <option value="0">—</option>
        <option value="11" {{ old('site_id', @$model->site_id) === 11 ? 'selected' : '' }}>ivacuum.ru [ru]</option>
        <option value="12" {{ old('site_id', @$model->site_id) === 12 ? 'selected' : '' }}>ivacuum.ru [en]</option>
      </select>
    </div>
  </div>
</div>

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

<div class="form-group {{ $errors->has('html') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">HTML:</label>
  <div class="col-md-9">
    <textarea required class="form-control textarea-autosized js-autosize-textarea" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>
