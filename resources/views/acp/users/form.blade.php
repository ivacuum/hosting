@include('tpl.form_errors')

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Электронная почта:</label>
  <div class="col-md-9">
    <input required class="form-control" type="email" name="email" value="{{ old('email', @$model->email) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Пароль:</label>
  <div class="col-md-9">
    <input required class="form-control" type="password" name="password">
  </div>
</div>

<div class="form-group flush">
  <div class="col-md-9 col-md-offset-3 checkbox">
    <input type="hidden" name="status" value="0">
    <label>
      <input type="checkbox" name="status" value="1" {{ 1 == old('status', @$model->status) ? 'checked' : '' }}>
      Активен
    </label>
  </div>
</div>

<div class="form-group flush">
  <div class="col-md-9 col-md-offset-3 checkbox">
    <label>
      <input type="checkbox" name="random_password" value="1" {{ old('random_password') ? 'checked' : '' }}>
      Установить случайный пароль
    </label>
  </div>
</div>

<div class="form-group">
  <div class="col-md-9 col-md-offset-3 checkbox">
    <label>
      <input type="checkbox" name="mail_credentials" value="1" {{ old('mail_credentials') ? 'checked' : '' }}>
      Выслать данные на почту
    </label>
  </div>
</div>
