@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('host')->required()->placeholder('srv1.example.com')->html() !!}
{!! Form::textarea('text')->wide()->html() !!}

<div class="tw-mb-4">
  <label>FTP</label>
  <div class="input-group">
    <input class="form-control" type="text" name="ftp_user" placeholder="user" value="{{ old('ftp_user', @$model->ftp_user) }}">
    <div class="input-group-append">
      <span class="input-group-text border-right-0">:</span>
    </div>
    <input class="form-control" type="password" name="ftp_pass" placeholder="password">
    <div class="input-group-append">
      <span class="input-group-text border-right-0">@</span>
    </div>
    <input class="form-control" type="text" name="ftp_host" placeholder="srv1.example.com" value="{{ old('ftp_host', @$model->ftp_host) }}">
    <input class="form-control" type="text" name="ftp_root" placeholder="/srv/www/vhosts" value="{{ old('ftp_root', @$model->ftp_root) }}">
  </div>
  <div class="form-help">Адрес хоста фтп не нужно вводить, если он не отличается хоста самого сервера</div>
</div>
