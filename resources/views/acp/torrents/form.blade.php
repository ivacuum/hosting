@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Название:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$model->title) }}">
  </div>
</div>
