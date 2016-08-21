@extends('acp.base')

@section('content_header')
<div class="row m-t-2">
  <div class="col-sm-3">
    <div class="list-group list-group-svg">
      <a class="list-group-item {{ $view == 'acp.gigs.show' ? 'active' : '' }}" href="{{ action("$self@show", $gig) }}">
        Концерт
      </a>
      <a class="list-group-item {{ $view == 'acp.gigs.edit' ? 'active' : '' }}" href="{{ action("$self@edit", [$gig, 'goto' => Request::fullUrl()]) }}">
        Редактировать
      </a>
      @include('acp.tpl.delete', ['id' => $gig])
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="m-t-0">
      @include('acp.tpl.back')
      {{ $gig->title }}
      <small>{{ $gig->fullDate() }}</small>
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
