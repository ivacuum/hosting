@extends('base')

@section('content_header')
<div class="lg:flex lg:-mx-4">
  <div class="lg:w-3/12 lg:px-4">
    <div class="list-group text-center">
      @if (Auth::user()->isAdmin())
        <a class="list-group-item list-group-item-action md:hidden" href="{{ App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips?user_id=1" }}">
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
      <a class="list-group-item list-group-item-action md:hidden" href="{{ path('Notifications@index') }}">
        {{ trans('notifications.index') }}
      </a>
      <a class="list-group-item list-group-item-action md:hidden" href="{{ path('Auth\SignIn@logout') }}">
        {{ trans('auth.logout') }}
      </a>
    </div>
  </div>
  <div class="lg:w-9/12 lg:px-4 mt-4 lg:mt-0">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
