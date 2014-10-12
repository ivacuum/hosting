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
    {{ Form::select('client_id', Client::find(1)->lists('name', 'id'), null, [
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