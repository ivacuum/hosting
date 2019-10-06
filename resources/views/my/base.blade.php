@extends('base')

@section('content_header')
<div class="lg:flex lg:-mx-4">
  <div class="lg:w-2/12 lg:px-4">
    <div class="flex flex-col w-full">
      @if (Auth::user()->isAdmin())
        @component('tpl.list-group-item', [
          'href' => App::isLocal()
            ? path([App\Http\Controllers\Acp\Dev\Templates::class, 'index'])
            : path([App\Http\Controllers\Acp\Trips::class, 'index'], ['user_id' => 1]),
          'classes' => 'md:hidden',
        ])
          {{ trans('acp.index') }}
        @endcomponent
      @endif
      @component('tpl.list-group-item', [
        'href' => path([App\Http\Controllers\MyProfile::class, 'edit']),
        'isActive' => $controller === App\Http\Controllers\MyProfile::class,
      ])
        {{ trans('my.profile') }}
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => path([App\Http\Controllers\MyPassword::class, 'edit']),
        'isActive' => $controller === App\Http\Controllers\MyPassword::class,
      ])
        {{ trans('my.password') }}
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => path([App\Http\Controllers\MySettings::class, 'edit']),
        'isActive' => $controller === App\Http\Controllers\MySettings::class,
      ])
        {{ trans('my.settings') }}
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => path([App\Http\Controllers\MyTrips::class, 'index']),
        'isActive' => $controller === App\Http\Controllers\MyTrips::class,
      ])
        {{ trans('my.trips') }}
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => path([App\Http\Controllers\Notifications::class, 'index']),
        'classes' => 'md:hidden',
      ])
        {{ trans('notifications.index') }}
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => path([App\Http\Controllers\Auth\SignIn::class, 'logout']),
        'classes' => 'md:hidden',
      ])
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
