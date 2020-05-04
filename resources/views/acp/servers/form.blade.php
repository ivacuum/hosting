@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('host')->required()->placeholder('srv1.example.com')->html() !!}
{!! Form::textarea('text')->wide()->html() !!}

<div class="mb-4">
  <label class="font-bold">FTP</label>
  <div class="flex items-center w-full">
    <input class="form-input" type="text" name="ftp_user" placeholder="user" value="{{ old('ftp_user', @$model->ftp_user) }}">
    <div class="mx-2">:</div>
    <input class="form-input" type="password" name="ftp_pass" placeholder="password">
    <span class="mx-2">@</span>
    <input class="form-input rounded-r-none" type="text" name="ftp_host" placeholder="srv1.example.com" value="{{ old('ftp_host', @$model->ftp_host) }}">
    <input class="form-input -ml-px rounded-l-none" type="text" name="ftp_root" placeholder="/srv/www/vhosts" value="{{ old('ftp_root', @$model->ftp_root) }}">
  </div>
  <div class="form-help">Адрес хоста фтп не нужно вводить, если он не отличается хоста самого сервера</div>
</div>
