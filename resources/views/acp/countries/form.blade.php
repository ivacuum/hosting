@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Название:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$country->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">URL:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="slug" value="{{ old('slug', @$country->slug) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Emoji:</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="emoji" maxlength="20" value="{{ old('emoji', @$country->emoji) }}">
  </div>
</div>
