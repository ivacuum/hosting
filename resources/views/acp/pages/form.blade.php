@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-2 control-label required">Название страницы:</label>
  <div class="col-md-10">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$model->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
  <label class="col-md-2 control-label required">URL:</label>
  <div class="col-md-10">
    <div class="input-group">
      <div class="input-group-addon">{{ url('/') }}/</div>
      <input required type="text" class="form-control" name="url" value="{{ old('url', @$model->url) }}">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Обработчик:</label>
  <div class="col-md-10">
    <div class="input-group">
      <input type="text" class="form-control" name="handler" value="{{ old('handler', @$model->handler) }}">
      <div class="input-group-addon">@</div>
      <input type="text" class="form-control" name="method" value="{{ old('method', @$model->method) }}">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">HTML:</label>
  <div class="col-md-10">
    <textarea class="form-control textarea-autosized js-autosize-textarea" rows="2" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>

<div class="form-group">
  <div class="col-md-10 col-md-offset-2 checkbox">
    <input type="hidden" name="active" value="0">
    <label>
      <input type="checkbox" name="active" value="1" {{ 1 == old('active', @$model->active) ? 'checked' : '' }}>
      Отображается на сайте?
    </label>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Фильтры:</label>
  <div class="col-md-10">
    <input type="text" class="form-control" name="middleware" value="{{ old('middleware', @$model->middleware) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Редирект:</label>
  <div class="col-md-10">
    <input type="text" class="form-control" name="redirect" value="{{ old('redirect', @$model->redirect) }}">
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3 style="margin-bottom: 0.5em;">Информация для продвижения</h3>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Заголовок:</label>
  <div class="col-md-10">
    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', @$model->meta_title) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Ключевые слова:</label>
  <div class="col-md-10">
    <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', @$model->meta_keywords) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Описание:</label>
  <div class="col-md-10">
    <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description', @$model->meta_description) }}">
    <p class="help-block">до 255 знаков</p>
  </div>
</div>
