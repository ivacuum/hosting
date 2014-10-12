@if ($errors->has())
  <div class="alert alert-danger">
    {{ HTML::ul($errors->all()) }}
  </div>
@endif

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  {{ Form::label('name', 'Имя:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('email', 'Элетронная почта:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::email('email', null, ['class' => 'form-control']) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('text', 'Комментарии:', ['class' => 'col-md-2 control-label']) }}
  <div class="col-md-10">
    {{ Form::textarea('text', null, ['class' => 'form-control']) }}
  </div>
</div>