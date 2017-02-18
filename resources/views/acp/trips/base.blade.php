@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <div class="list-group text-center">
      <a class="list-group-item {{ $view == "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
        {{ trans("$tpl.show") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.edit" ? 'active' : '' }}" href="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
        {{ trans("$tpl.edit") }}
      </a>
      @include('acp.tpl.delete', ['id' => $model])
    </div>
    <form class="text-center mb-3" action="{{ action("$self@notify", $model) }}" method="post">
      <button class="btn btn-default" type="submit">{{ trans("$tpl.notify") }}</button>
      {{ csrf_field() }}
    </form>
  </div>
  <div class="col-sm-9">
    <h2 class="mt-0">
      @include('acp.tpl.back')
      {{ $model->title }}
      <small>{{ $model->localizedDate() }}</small>
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
