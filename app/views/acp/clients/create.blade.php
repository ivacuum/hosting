@extends('acp.base')

@section('content')
<div class="boxed-group">
  <h3>
    <a href="{{ route('acp.clients.index') }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
    Новый клиент
  </h3>
  <div class="boxed-group-inner">
    {{ Form::open([
      'route' => 'acp.clients.store',
      'class' => 'form-horizontal'
    ]) }}

    @include('acp.clients.form')

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Добавить клиента', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop