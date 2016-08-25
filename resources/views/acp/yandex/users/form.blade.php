@include('tpl.form_errors')

<div class="form-group {{ $errors->has('account') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Логин в Яндексе:</label>
  <div class="col-md-9">
    <input required type="text" class="form-control" name="account" value="{{ old('account', @$model->account) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('token') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label {{ !@$model->token ? 'required' : '' }}">Токен:</label>
  <div class="col-md-9">
    <input {{ !@$model->token ? 'required' : '' }} type="password" class="form-control" name="token">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Домены:</label>
  <div class="col-md-9 checkbox">
    @foreach ($domains as $domain)
      <label>
        <input type="checkbox" name="domains[{{ $domain->id }}]" value="1" {{ @$model->id && @$model->id == $domain->yandex_user_id ? 'checked' : '' }}>
        {{ $domain->domain }}
      </label>
      <br>
    @endforeach
  </div>
</div>
