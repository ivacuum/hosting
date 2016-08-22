@extends('acp.base')

@section('content_header')
<div class="row m-t-2">
  <div class="col-sm-3">
    <div class="list-group list-group-svg">
      <a class="list-group-item {{ $view == "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
        {{ trans("$tpl.show") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.edit" ? 'active' : '' }}" href="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
        {{ trans("$tpl.edit") }}
      </a>
      @include('acp.tpl.delete', ['id' => $model])
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="m-t-0">
      @include('acp.tpl.back')
      {{ $model->country->emoji }}
      {{ $model->title }}
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
