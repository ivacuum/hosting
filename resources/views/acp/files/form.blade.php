@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Название:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$model->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('folder') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Папка:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="folder" value="{{ old('folder', @$model->folder) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">URL:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="slug" value="{{ old('slug', @$model->slug) }}">
  </div>
</div>
