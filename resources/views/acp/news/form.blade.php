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

<div class="form-group mt-4 {{ $errors->has('html') ? 'has-error' : '' }}">
  <div class="col-xs-12">
    <textarea required class="form-control textarea-autosized textarea-borderless-focus js-autosize-textarea" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Статус:</label>
  <div class="col-md-6">
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\News::STATUS_HIDDEN }}" {{ App\News::STATUS_HIDDEN == old('status', @$model->status) ? 'checked' : '' }}>
        <span class="text-muted">Скрыта</span>
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\News::STATUS_PUBLISHED }}" {{ App\News::STATUS_PUBLISHED == old('status', @$model->status) ? 'checked' : '' }}>
        <span class="text-success">Опубликована</span>
      </label>
    </div>
  </div>
</div>
