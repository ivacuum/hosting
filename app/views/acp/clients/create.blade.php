@extends('acp.base')

@section('content')
<div class="boxed-group">
  <h3>
    <a href="{{ action("$self@index") }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
    Новый клиент
  </h3>
  <div class="boxed-group-inner">
    {{ Form::open([
      'action' => "$self@store",
      'class' => 'form-horizontal'
    ]) }}

    @include("$tpl.form")

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Добавить клиента', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop