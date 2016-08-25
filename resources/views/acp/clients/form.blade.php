@include('tpl.form_errors')

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  <label class="col-md-2 control-label required">Имя:</label>
  <div class="col-md-10">
    <input required type="text" class="form-control" name="name" value="{{ old('name', @$model->name) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Электронная почта:</label>
  <div class="col-md-10">
    <input type="email" class="form-control" name="email" value="{{ old('email', @$model->email) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Заметки:</label>
  <div class="col-md-10">
    <textarea class="form-control" name="text" rows="10">{{ old('text', @$model->text) }}</textarea>
  </div>
</div>
