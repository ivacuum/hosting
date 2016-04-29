@extends('acp.base')

@section('content_header')
  <div class="row line-before">
    <div class="col-sm-3">
      <div class="list-group list-group-svg">
        <a class="list-group-item {{ $view == 'acp.countries.show' ? 'active' : '' }}" href="{{ action("$self@show", $country) }}">
          Страна
        </a>
        <a class="list-group-item {{ $view == 'acp.countries.edit' ? 'active' : '' }}" href="{{ action("$self@edit", [$country, 'goto' => Request::fullUrl()]) }}">
          Редактировать
        </a>
        @include('acp.tpl.delete', ['id' => $country])
      </div>
    </div>
    <div class="col-sm-9">
      <h2>
        @include('acp.tpl.back')
        {{ $country->title }}
      </h2>
      @endsection

      @section('content_footer')
    </div>
  </div>
@endsection
