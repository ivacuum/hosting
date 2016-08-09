@extends('acp.base')

@section('content_header')
<div class="row m-t-2">
  <div class="col-sm-3">
    <div class="list-group list-group-svg">
      <a class="list-group-item {{ $view == 'acp.cities.show' ? 'active' : '' }}" href="{{ action("$self@show", $city) }}">
        Город
      </a>
      <a class="list-group-item {{ $view == 'acp.cities.edit' ? 'active' : '' }}" href="{{ action("$self@edit", [$city, 'goto' => Request::fullUrl()]) }}">
        Редактировать
      </a>
      @include('acp.tpl.delete', ['id' => $city])
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="m-t-0">
      @include('acp.tpl.back')
      {{ $city->title }}
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
