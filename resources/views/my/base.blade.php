@extends('base')

@section('content_header')
<div class="lg:flex lg:-mx-4">
  <div class="lg:w-2/12 lg:px-4">
    <div class="flex flex-col w-full">
      @if (Auth::user()->isAdmin())
        @component('tpl.list-group-item', ['href' => App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips?user_id=1", 'classes' => 'md:hidden'])
          {{ trans('acp.index') }}
        @endcomponent
      @endif
      @component('tpl.list-group-item', ['href' => path('MyProfile@edit'), 'isActive' => $self === 'MyProfile'])
        {{ trans('my.profile') }}
      @endcomponent
      @component('tpl.list-group-item', ['href' => path('MyPassword@edit'), 'isActive' => $self === 'MyPassword'])
        {{ trans('my.password') }}
      @endcomponent
      @component('tpl.list-group-item', ['href' => path('MySettings@edit'), 'isActive' => $self === 'MySettings'])
        {{ trans('my.settings') }}
      @endcomponent
      @component('tpl.list-group-item', ['href' => path('MyTrips@index'), 'isActive' => $self === 'MyTrips'])
        {{ trans('my.trips') }}
      @endcomponent
      @component('tpl.list-group-item', ['href' => path('Notifications@index'), 'classes' => 'md:hidden'])
        {{ trans('notifications.index') }}
      @endcomponent
      @component('tpl.list-group-item', ['href' => path('Auth\SignIn@logout'), 'classes' => 'md:hidden'])
        {{ trans('auth.logout') }}
      @endcomponent
    </div>
  </div>
  <div class="lg:w-10/12 lg:px-4 mt-4 lg:mt-0">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
