@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-2 control-label required">Название:</label>
  <div class="col-md-10">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$model->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('host') ? 'has-error' : '' }}">
  <label class="col-md-2 control-label required">Хост:</label>
  <div class="col-md-10">
    <input required type="text" class="form-control" name="host" placeholder="srv1.example.com" value="{{ old('host', @$model->host) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Заметки:</label>
  <div class="col-md-10">
    <textarea class="form-control textarea-autosized js-autosize-textarea" name="text" rows="2">{{ old('text', @$model->text) }}</textarea>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3>Реквизиты доступа</h3>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">FTP:</label>
  <div class="col-md-10">
    <div class="input-group">
      <input type="text" class="form-control" name="ftp_user" placeholder="user" value="{{ old('ftp_user', @$model->ftp_user) }}">
      <span class="input-group-addon">:</span>
      <input type="password" class="form-control" name="ftp_pass">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" name="ftp_host" placeholder="srv1.example.com" value="{{ old('ftp_host', @$model->ftp_host) }}">
      <span class="input-group-addon"></span>
      <input type="text" class="form-control" name="ftp_root" placeholder="/srv/www/vhosts" value="{{ old('ftp_root', @$model->ftp_root) }}">
    </div>
    <p class="help-block">Адрес хоста фтп не нужно вводить, если он не отличается от такового сервера</p>
  </div>
</div>
