@include('tpl.form_errors')

{!! Form::text('domain')->required()->placeholder('example.com')->html() !!}

{!! Form::select('alias_id')->values(App\Domain::orderBy('domain')->pluck('domain', 'id'))->html() !!}

{!! Form::select('client_id')->values(App\Client::pluck('name', 'id'))->html() !!}

{!! Form::select('yandex_user_id')->values(App\YandexUser::pluck('account', 'id'))->html() !!}

{!! Form::checkbox('status')
  ->label('')
  ->default(0)
  ->values([1 => 'Мониторинг домена'])
  ->html() !!}

{!! Form::checkbox('domain_control')
  ->label('')
  ->default(0)
  ->values([1 => 'Домен в нашей панели reg.ru'])
  ->html() !!}

{!! Form::checkbox('orphan')
  ->label('')
  ->default(0)
  ->values([1 => 'Домен на продажу'])
  ->html() !!}

{!! Form::textarea('text')->wide()->html() !!}

<h3 class="mt-12 mb-4">Реквизиты доступа к сайту</h3>

<div class="mb-4">
  <label>CMS</label>
  <div class="flex items-center w-full">
    <input class="form-input" type="text" name="cms_user" placeholder="admin" value="{{ old('cms_user', @$model->cms_user) }}">
    <div class="mx-2">:</div>
    <input class="form-input" type="password" name="cms_pass" placeholder="password">
    <div class="mx-2">@</div>
    <input class="form-input" type="text" name="cms_url" placeholder="http://example.com/acp/" value="{{ old('cms_url', @$model->cms_url) }}">
  </div>
</div>

<div class="mb-4">
  <label>Название CMS</label>
  <input class="form-input" type="text" name="cms_type" placeholder="korden.cms" value="{{ old('cms_type', @$model->cms_type) }}">
</div>

<div class="mb-4">
  <label>Версия CMS</label>
  <input class="form-input" type="text" name="cms_version" placeholder="3.5" value="{{ old('cms_version', @$model->cms_version) }}">
</div>

<div class="mb-4">
  <label>FTP</label>
  <div class="flex items-center w-full">
    <input class="form-input" type="text" name="ftp_user" placeholder="user" value="{{ old('ftp_user', @$model->ftp_user) }}">
    <div class="mx-2">:</div>
    <input class="form-input" type="password" name="ftp_pass" placeholder="password">
    <div class="mx-2">@</div>
    <input class="form-input" type="text" name="ftp_host" placeholder="ftp://example.com/" value="{{ old('ftp_host', @$model->ftp_host) }}">
  </div>
</div>

<div class="mb-4">
  <label>SSH</label>
  <div class="flex items-center w-full">
    <input class="form-input" type="text" name="ssh_user" placeholder="user" value="{{ old('ssh_user', @$model->ssh_user) }}">
    <div class="mx-2">:</div>
    <input class="form-input" type="password" name="ssh_pass" placeholder="password">
    <div class="mx-2">@</div>
    <input class="form-input" type="text" name="ssh_host" placeholder="ssh://example.com/" value="{{ old('ssh_host', @$model->ssh_host) }}">
  </div>
</div>

<div class="mb-4">
  <label>БД</label>
  <div class="flex items-center w-full">
    <input class="form-input" type="text" name="db_user" placeholder="user" value="{{ old('db_user', @$model->db_user) }}">
    <div class="mx-2">:</div>
    <input class="form-input" type="password" name="db_pass" placeholder="password">
    <div class="mx-2">@</div>
    <input class="form-input" type="text" name="db_host" placeholder="localhost" value="{{ old('db_host', @$model->db_host) }}">
  </div>
</div>

<div class="mb-4">
  <label>phpMyAdmin</label>
  <input class="form-input" type="text" name="db_pma" placeholder="http://pma.example.com/" value="{{ old('db_pma', @$model->db_pma) }}">
</div>
