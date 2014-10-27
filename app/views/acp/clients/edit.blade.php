@extends('acp.base')

@section('content')
<div class="boxed-group">
  <h3>
    <a href="{{ Input::get('goto') ?: route('acp.clients.index') }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
    Редактирование данных клиента <small>{{ $client->name }}</small>
  </h3>
  <div class="boxed-group-inner">
    {{ Form::model($client, [
      'route' => ['acp.clients.update', $client->id],
      'method' => 'put',
      'class' => 'form-horizontal'
    ]) }}

    @include('acp.clients.form')

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Обновить информацию', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop
