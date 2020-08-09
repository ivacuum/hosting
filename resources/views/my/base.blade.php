@extends('base')

@section('content_header')
<div class="grid lg:grid-cols-6 gap-8">
  <div>
    <div class="flex flex-col w-full">
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
        'isActive' => $routeUri === 'my/trips',
      ])
        @lang('Поездки')
      @endcomponent
      @component('tpl.list-group-item', [
        'href' => to('notifications'),
        'classes' => 'md:hidden',
      ])
        @lang('Уведомления')
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
