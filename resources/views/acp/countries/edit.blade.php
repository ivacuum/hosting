@extends('acp.countries.base')

@section('content')
<form action="{{ action("$self@update", $country) }}" class="form-horizontal" method="post">

  @include("$tpl.form")
  @include('acp.tpl.hidden_fields', ['method' => 'put'])

  <div class="form-group">
    <div class="col-md-9 col-md-offset-3">
      <button type="submit" class="btn btn-primary">
        Сохранить
      </button>
      <button type="submit" name="_save" class="btn btn-default">
        Применить
      </button>
    </div>
  </div>
</form>
@endsection
