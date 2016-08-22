@extends('acp.base')

@section('content')
<h3>
  @include('acp.tpl.back')
  Новый аккаунт
</h3>
<form action="{{ action("$self@store") }}" class="form-horizontal" method="post">

  @include("$tpl.form")
  @include('acp.tpl.hidden_fields')

  <div class="form-group">
    <div class="col-md-10 col-md-offset-2">
      <button type="submit" class="btn btn-primary">
        Добавить аккаунт
      </button>
    </div>
  </div>
</form>
@endsection
