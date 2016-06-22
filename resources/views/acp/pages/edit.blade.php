@extends('acp.base')

@section('content')
<div class="boxed-group">
  <h3>
    @include('acp.tpl.back')
    Редактирование страницы <small>{{ $page->title }}</small>
  </h3>
  <div class="boxed-group-inner">
    <form action="{{ action("$self@update", $page) }}" class="form-horizontal" method="post">

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
  </div>
</div>
@endsection
