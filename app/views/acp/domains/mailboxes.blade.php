<div class="boxed-group">
  <h3>Новая электропочта</h3>
  <div class="boxed-group-inner">

    {{ Form::open(['action' => ["$self@addMailbox", $domain->domain], 'class' => 'form-horizontal']) }}

    @if ($errors->has())
      <div class="alert alert-danger">
        {{ HTML::ul($errors->all()) }}
      </div>
    @endif

    <div class="form-group {{ $errors->has('domain') ? 'has-error' : '' }}">
      {{ Form::label('logins', 'Ящик:', ['class' => 'col-md-2 control-label']) }}
      <div class="col-md-6">
        <div class="input-group">
          {{ Form::text('logins', null, ['class' => 'form-control']) }}
          <span class="input-group-addon">{{ '@'.$domain->domain }}</span>
        </div>
        <span class="help-block">Можно указать несколько ящиков через запятую. Пароли будут назначены автоматически</span>
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('forward', 'Переадресация:', ['class' => 'col-md-2 control-label']) }}
      <div class="col-md-6">
        {{ Form::email('forward', null, ['class' => 'form-control']) }}
      </div>
    </div>
    
    <div class="form-group">
      {{ Form::label('send_to', 'Выслать инфу на:', ['class' => 'col-md-2 control-label']) }}
      <div class="col-md-6">
        {{ Form::email('send_to', Auth::user()->email, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Создать ящик', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}

  </div>
</div>
