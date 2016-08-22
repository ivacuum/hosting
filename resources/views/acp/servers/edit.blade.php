@extends('acp.base')

@section('content')
<h3>
  @include('acp.tpl.back')
  Редактирование данных сервера <small>{{ $server->name }}</small>
</h3>
<form action="{{ action("$self@update", $server) }}" class="form-horizontal" method="post">

  @include("$tpl.form")
  @include('acp.tpl.hidden_fields', ['method' => 'put'])

  <div class="form-group">
    <div class="col-md-10 col-md-offset-2">
      <button type="submit" class="btn btn-primary">
        Обновить информацию
      </button>
    </div>
  </div>
</form>
@endsection
