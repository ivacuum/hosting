@extends('acp.base')

@section('content_header')
  <div class="row line-before">
    <div class="col-sm-3">
      <div class="list-group list-group-svg">
        <a class="list-group-item {{ $view == 'acp.trips.show' ? 'active' : '' }}" href="{{ action("$self@show", $trip) }}">
          Поездка
        </a>
        <a class="list-group-item {{ $view == 'acp.trips.edit' ? 'active' : '' }}" href="{{ action("$self@edit", [$trip, 'goto' => Request::fullUrl()]) }}">
          Редактировать
        </a>
        @include('acp.tpl.delete', ['id' => $trip])
      </div>
    </div>
    <div class="col-sm-9">
      <h2>
        @include('acp.tpl.back')
        {{ $trip->title }}
        <small>{{ $trip->getLocalizedDate() }}</small>
      </h2>
      @endsection

      @section('content_footer')
    </div>
  </div>
@endsection
