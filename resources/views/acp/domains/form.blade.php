@include('tpl.form_errors')

<div class="form-group {{ $errors->has('domain') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Домен:</label>
  <div class="col-md-4">
    <input required type="text" class="form-control" name="domain" placeholder="example.com" value="{{ old('domain', @$model->domain) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Алиас:</label>
  <div class="col-md-4">
    <select class="form-control" name="alias_id">
      <option value="0">нет</option>
      @foreach (App\Domain::orderBy('domain')->get() as $alias)
        <option value="{{ $alias->id }}" {{ $alias->id == old('alias_id', @$model->alias_id) ? 'selected' : '' }}>
          {{ $alias->domain }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Клиент:</label>
  <div class="col-md-4">
    <select class="form-control" name="client_id">
      @foreach (App\Client::all() as $client)
        <option value="{{ $client->id }}" {{ $client->id == old('client_id', @$model->client_id) ? 'selected' : '' }}>
          {{ $client->name }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Пользователь API Яндекса:</label>
  <div class="col-md-4">
    <select class="form-control" name="yandex_user_id">
      <option value="0">нет</option>
      @foreach (App\YandexUser::all() as $user)
        <option value="{{ $user->id }}" {{ $user->id == old('yandex_user_id', @$model->yandex_user_id) ? 'selected' : '' }}>
          {{ $user->account }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group flush">
  <div class="col-md-9 col-md-offset-3 checkbox">
    <input type="hidden" name="active" value="0">
    <label>
      <input type="checkbox" name="active" value="1" {{ 1 == old('active', @$model->active) ? 'checked' : '' }}>
      Мониторинг домена
    </label>
  </div>
</div>

<div class="form-group flush">
  <div class="col-md-9 col-md-offset-3 checkbox">
    <input type="hidden" name="domain_control" value="0">
    <label>
      <input type="checkbox" name="domain_control" value="1" {{ 1 == old('domain_control', @$model->domain_control) ? 'checked' : '' }}>
      Домен в нашей панели reg.ru
    </label>
  </div>
</div>

<div class="form-group">
  <div class="col-md-9 col-md-offset-3 checkbox">
    <input type="hidden" name="orphan" value="0">
    <label>
      <input type="checkbox" name="orphan" value="1" {{ 1 == old('orphan', @$model->orphan) ? 'checked' : '' }}>
      Домен на продажу
    </label>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Заметки:</label>
  <div class="col-md-6">
    <textarea class="form-control textarea-autosized js-autosize-textarea" name="text" rows="2">{{ old('text', @$model->text) }}</textarea>
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-9 col-md-offset-3">
    <h3 style="margin-bottom: 0.5em;">Реквизиты доступа к сайту</h3>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">CMS:</label>
  <div class="col-md-9">
    <div class="input-group">
      <input type="text" class="form-control" name="cms_user" placeholder="admin" value="{{ old('cms_user', @$model->cms_user) }}">
      <span class="input-group-addon">:</span>
      <input type="password" class="form-control" name="cms_pass">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" name="cms_url" placeholder="http://example.com/acp/" value="{{ old('cms_url', @$model->cms_url) }}">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Название CMS:</label>
  <div class="col-md-9">
    <input type="text" class="form-control" name="cms_type" placeholder="korden.cms" value="{{ old('cms_type', @$model->cms_type) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Версия CMS:</label>
  <div class="col-md-9">
    <input type="text" class="form-control" name="cms_version" placeholder="3.5" value="{{ old('cms_version', @$model->cms_version) }}">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">FTP:</label>
  <div class="col-md-9">
    <div class="input-group">
      <input type="text" class="form-control" name="ftp_user" placeholder="user" value="{{ old('ftp_user', @$model->ftp_user) }}">
      <span class="input-group-addon">:</span>
      <input type="password" class="form-control" name="ftp_pass">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" name="ftp_host" placeholder="ftp://example.com/" value="{{ old('ftp_host', @$model->ftp_host) }}">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">SSH:</label>
  <div class="col-md-9">
    <div class="input-group">
      <input type="text" class="form-control" name="ssh_user" placeholder="user" value="{{ old('ssh_user', @$model->ssh_user) }}">
      <span class="input-group-addon">:</span>
      <input type="password" class="form-control" name="ssh_pass">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" name="ssh_host" placeholder="ssh://example.com/" value="{{ old('ssh_host', @$model->ssh_host) }}">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">БД:</label>
  <div class="col-md-9">
    <div class="input-group">
      <input type="text" class="form-control" name="db_user" placeholder="user" value="{{ old('db_user', @$model->db_user) }}">
      <span class="input-group-addon">:</span>
      <input type="password" class="form-control" name="db_pass">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" name="db_host" placeholder="localhost" value="{{ old('db_host', @$model->db_host) }}">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">phpMyAdmin:</label>
  <div class="col-md-9">
    <input type="text" class="form-control" name="db_pma" placeholder="http://pma.example.com/" value="{{ old('db_pma', @$model->db_pma) }}">
  </div>
</div>
