@if ($errors->has())
  <div class="alert alert-danger">
    {{ HTML::ul($errors->all()) }}
  </div>
@endif

<div class="form-group {{ $errors->has('domain') ? 'has-error' : '' }}">
  {{ Form::label('domain', 'Домен:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('domain', null, [
      'class' => 'form-control',
      'placeholder' => 'example.com'
    ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('client_id', 'Клиент:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::select('client_id', Client::all()->lists('name', 'id'), null, [
      'class' => 'form-control'
    ]) }}
  </div>
</div>

<div class="form-group flush">
  <div class="col-md-10 col-md-offset-2 checkbox">
    {{ Form::hidden('active', 0) }}
    <label>{{ Form::checkbox('active') }} Мониторинг домена</label>
  </div>
</div>

<div class="form-group">
  <div class="col-md-10 col-md-offset-2 checkbox">
    {{ Form::hidden('domain_control', 0) }}
    <label>{{ Form::checkbox('domain_control')}} Домен в нашей панели</label>
  </div>
</div>

<div class="form-group">
  {{ Form::label('text', 'Заметки:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::textarea('text', null, ['class' => 'form-control']) }}
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3 style="margin-bottom: 0.5em;">Реквизиты доступа к системе управления сайтом</h3>
  </div>
</div>

<div class="form-group">
  {{ Form::label('cms_url', 'Адрес:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('cms_url', null, [
    'class' => 'form-control',
    'placeholder' => 'http://example.com/acp/'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('cms_user', 'Учетка:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('cms_user', null, [
    'class' => 'form-control',
    'placeholder' => 'admin'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('cms_pass', 'Пароль:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::password('cms_pass', ['class' => 'form-control']) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('cms_type', 'Название CMS:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('cms_type', null, [
    'class' => 'form-control',
    'placeholder' => 'korden.cms'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('cms_version', 'Версия:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('cms_version', null, [
    'class' => 'form-control',
    'placeholder' => '3.5'
  ]) }}
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3 style="margin-bottom: 0.5em;">FTP</h3>
  </div>
</div>

<div class="form-group">
  {{ Form::label('ftp_host', 'Хост:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('ftp_host', null, [
    'class' => 'form-control',
    'placeholder' => 'ftp://example.com/'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('ftp_user', 'Учетка:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('ftp_user', null, [
    'class' => 'form-control',
    'placeholder' => 'user'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('ftp_pass', 'Пароль:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::password('ftp_pass', ['class' => 'form-control']) }}
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3 style="margin-bottom: 0.5em;">SSH</h3>
  </div>
</div>

<div class="form-group">
  {{ Form::label('ssh_host', 'Хост:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('ssh_host', null, [
    'class' => 'form-control',
    'placeholder' => 'ssh://example.com/'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('ssh_user', 'Учетка:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('ssh_user', null, [
    'class' => 'form-control',
    'placeholder' => 'user'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('ssh_pass', 'Пароль:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::password('ssh_pass', ['class' => 'form-control']) }}
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3 style="margin-bottom: 0.5em;">БД</h3>
  </div>
</div>

<div class="form-group">
  {{ Form::label('db_pma', 'phpMyAdmin:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('db_pma', null, [
    'class' => 'form-control',
    'placeholder' => 'http://pma.example.com/'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('db_host', 'Хост:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('db_host', null, [
    'class' => 'form-control',
    'placeholder' => 'localhost'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('db_user', 'Учетка:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('db_user', null, [
    'class' => 'form-control',
    'placeholder' => 'user'
  ]) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('db_pass', 'Пароль:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::password('db_pass', ['class' => 'form-control']) }}
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h3 style="margin-bottom: 0.5em;">Яндекс API</h3>
  </div>
</div>

<div class="form-group">
  {{ Form::label('yandex_user_id', 'Учетка:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::select('yandex_user_id', [0 => ''] + YandexUser::all()->lists('account', 'id'), null, [
      'class' => 'form-control'
    ]) }}
  </div>
</div>

<input type="hidden" name="goto" value="{{ $goto }}">