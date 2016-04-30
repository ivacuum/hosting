@extends('acp.base')

@section('content')
<div class="boxed-group">
  <h3>
    @include('acp.tpl.back')
    Новая поездка
  </h3>
  <div class="boxed-group-inner">
    <form action="{{ action("$self@store") }}" class="form-horizontal" method="post">

      @include("$tpl.form")
      @include('acp.tpl.hidden_fields')

      <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
          <button type="submit" class="btn btn-primary">
            Добавить поездку
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
