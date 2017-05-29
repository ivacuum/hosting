@extends('base')

@section('content_header')
<div class="row mt-3">
  <div class="col-sm-3">
    <div class="list-group text-center">
      @if (Auth::user()->isAdmin())
        <a class="list-group-item visible-xs" href="{{ App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips" }}">
          {{ trans('acp.index') }}
        </a>
      @endif
      <a class="list-group-item {{ $view == "$tpl.profile" ? 'active' : '' }}" href="{{ path("$self@profile") }}">
        {{ trans("$tpl.profile") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.password" ? 'active' : '' }}" href="{{ path("$self@password") }}">
        {{ trans("$tpl.password") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.settings" ? 'active' : '' }}" href="{{ path("$self@settings") }}">
        {{ trans("$tpl.settings") }}
      </a>
      <a class="list-group-item visible-xs" href="{{ path('Notifications@index') }}">
        {{ trans('notifications.index') }}
      </a>
      <a class="list-group-item visible-xs" href="{{ path('Auth@logout') }}">
        {{ trans('auth.logout') }}
      </a>
    </div>
  </div>
  <div class="col-sm-9">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
