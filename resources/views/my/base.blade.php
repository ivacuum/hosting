@extends('base')

@section('content_header')
<div class="grid lg:grid-cols-6 gap-8">
  <div>
    <div class="lg:hidden">
      <select
        class="the-input"
        onchange="window.location = this.value"
      >
        @if(Auth::user()->isAdmin())
          <option value="{{ App::isLocal()
            ? to('acp/dev/templates')
            : to('acp/trips', ['user_id' => 1]) }}"
          >@lang('acp.index')</option>
        @endif
        <option value="{{ to('my/profile') }}" {{ $routeUri === 'my/profile' ? 'selected' : '' }}>@lang('Профиль')</option>
        <option value="{{ to('my/password') }}" {{ $routeUri === 'my/password' ? 'selected' : '' }}>@lang('Пароль')</option>
        <option value="{{ to('my/settings') }}" {{ $routeUri === 'my/settings' ? 'selected' : '' }}>@lang('Настройки')</option>
        <option value="{{ to('my/trips') }}" {{ Str::of($routeUri)->is(['my/trips', 'my/trips/*']) ? 'selected' : '' }}>@lang('Поездки')</option>
        <option value="{{ to('auth/logout') }}">@lang('auth.logout')</option>
      </select>
    </div>
    <div class="hidden lg:flex flex-col w-full">
      @if (Auth::user()->isAdmin())
        @component('tpl.list-group-item', [
          'href' => App::isLocal()
            ? to('acp/dev/templates')
            : to('acp/trips', ['user_id' => 1]),
          'classes' => 'md:hidden',
        ])
          @lang('acp.index')
        @endcomponent
      @endif
      @component('tpl.list-group-item', [
        'href' => to('my/profile'),
        'isActive' => $routeUri === 'my/profile',
      ])
        @lang('Профиль')
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => to('my/password'),
        'isActive' => $routeUri === 'my/password',
      ])
        @lang('Пароль')
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => to('my/settings'),
        'isActive' => $routeUri === 'my/settings',
      ])
        @lang('Настройки')
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => to('my/trips'),
        'isActive' => Str::of($routeUri)->is(['my/trips', 'my/trips/*']),
      ])
        @lang('Поездки')
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => to('auth/logout'),
        'classes' => 'md:hidden',
      ])
        @lang('auth.logout')
      @endcomponent
    </div>
  </div>
  <div class="lg:col-span-5">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
