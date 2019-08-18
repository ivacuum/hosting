@extends('base')

@section('content_header')
<div class="row">
  <div class="col-lg-3">
    <div class="list-group text-center">
      @if (Auth::user()->isAdmin())
        <a class="list-group-item list-group-item-action d-md-none" href="{{ App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips?user_id=1" }}">
          {{ trans('acp.index') }}
        </a>
      @endif
      <a class="list-group-item list-group-item-action {{ $self === 'MyProfile' ? 'active' : '' }}" href="{{ path('MyProfile@edit') }}">
        {{ trans('my.profile') }}
      </a>
      <a class="list-group-item list-group-item-action {{ $self === 'MyPassword' ? 'active' : '' }}" href="{{ path('MyPassword@edit') }}">
        {{ trans('my.password') }}
      </a>
      <a class="list-group-item list-group-item-action {{ $self === 'MySettings' ? 'active' : '' }}" href="{{ path('MySettings@edit') }}">
        {{ trans('my.settings') }}
      </a>
      <a class="list-group-item list-group-item-action {{ $self === 'MyTrips' ? 'active' : '' }}" href="{{ path('MyTrips@index') }}">
        {{ trans('my.trips') }}
      </a>
      <a class="list-group-item list-group-item-action d-md-none" href="{{ path('Notifications@index') }}">
        {{ trans('notifications.index') }}
      </a>
      <a class="list-group-item list-group-item-action d-md-none" href="{{ path('Auth\SignIn@logout') }}">
        {{ trans('auth.logout') }}
      </a>
    </div>
  </div>
  <div class="col-lg-9 tw-mt-4 mt-lg-0">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
