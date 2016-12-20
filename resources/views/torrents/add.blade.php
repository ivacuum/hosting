@extends('torrents.base')

@section('content')
<form action="{{ action("$self@addPost") }}" class="form-horizontal" method="post">

  @include("$tpl.form")

  <div class="form-group">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">
        {{ trans("$tpl.add") }}
      </button>
    </div>
  </div>

  {{ csrf_field() }}
</form>
@endsection
