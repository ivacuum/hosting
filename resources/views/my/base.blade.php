@extends('base')

@section('content_header')
<div class="row mt-3">
  <div class="col-sm-3">
    <div class="list-group text-center">
      <a class="list-group-item {{ $view == "$tpl.profile" ? 'active' : '' }}" href="{{ action("$self@profile") }}">
        {{ trans("$tpl.profile") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.password" ? 'active' : '' }}" href="{{ action("$self@password") }}">
        {{ trans("$tpl.password") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.settings" ? 'active' : '' }}" href="{{ action("$self@settings") }}">
        {{ trans("$tpl.settings") }}
      </a>
    </div>
  </div>
  <div class="col-sm-9">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
