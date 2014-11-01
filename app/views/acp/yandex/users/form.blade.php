@if ($errors->has())
  <div class="alert alert-danger">
    {{ HTML::ul($errors->all()) }}
  </div>
@endif

<div class="form-group {{ $errors->has('account') ? 'has-error' : '' }}">
  {{ Form::label('account', 'Логин в Яндексе:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('account', null, ['class' => 'form-control']) }}
  </div>
</div>

<div class="form-group {{ $errors->has('token') ? 'has-error' : '' }}">
  {{ Form::label('token', 'Токен:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::password('token', ['class' => 'form-control']) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('domains', 'Домены:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10 checkbox">
    @foreach ($domains as $domain)
      <label>
        {{ Form::checkbox(
          'domains['.$domain->id.']',
          1,
          @$user->id == $domain->yandex_user_id
        ) }}
        {{ $domain->domain }}
      </label>
      <br>
    @endforeach
  </div>
</div>
