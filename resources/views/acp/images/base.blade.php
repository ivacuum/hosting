@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <div class="list-group list-group-svg">
      <a class="list-group-item {{ $view == "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
        {{ trans("$tpl.show") }}
      </a>
      <a class="list-group-item" href="{{ action("$self@view", $model) }}">
        {{ trans("$tpl.view") }}
      </a>
      <a class="list-group-item" href="{{ action("$self@index", ['user_id' => $model->user_id]) }}">
        {{ trans("$tpl.user") }}
      </a>
      @include('acp.tpl.delete', ['id' => $model])
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="m-t-0">
      @include('acp.tpl.back')
      {{ $model->slug }}
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
