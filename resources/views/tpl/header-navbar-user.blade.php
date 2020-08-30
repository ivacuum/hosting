<a
  class="border-b-2 border-transparent px-2 py-3 text-2xl text-grey-600 hover:text-grey-900 leading-none relative tooltipped tooltipped-s {{ $routeUri === 'notifications' ? 'border-blueish-600 text-grey-900' : '' }}"
  href="@lng/notifications"
  aria-label="@lang('Уведомления')"
>
  <span class="{{ Auth::user()->unreadNotifications()->first() ? 'has-unread-label' : '' }}">
    @svg (bell)
  </span>
</a>

<details class="self-center relative details-reset details-overlay text-grey-600 hover:text-grey-900">
  <summary class="p-2">
    <div class="flex items-center">
      @include('tpl.avatar', ['user' => Auth::user(), 'classes' => 'w-8 h-8'])
      @svg (angle-down)
    </div>
  </summary>
  <details-menu
    role="menu"
    class="absolute top-full right-0 z-50 py-2 bg-white mt-1 border border-gray-300 rounded shadow-md"
    style="min-width: 10rem;"
  >
    <div class="py-2 px-6 text-sm text-gray-600 whitespace-no-wrap">
      @lang('auth.signed_in_as')
      <span class="font-bold">{{ Auth::user()->displayName() }}</span>
    </div>
    <div class="h-0 my-2 overflow-hidden border-t border-gray-100"></div>
    @if (Auth::user()->isAdmin())
      <a
        class="dropdown-item"
        href="{{ to(App::isLocal() ? 'acp/dev/templates' : 'acp/trips?user_id=1') }}"
      >
        @lang('acp.index')
      </a>
      <a
        class="dropdown-item"
        href="/nova">
        Nova
      </a>
    @endif
    <a class="dropdown-item" href="@lng/my/profile">
      @lang('Аккаунт')
    </a>
    <div class="h-0 my-2 overflow-hidden border-t border-gray-100"></div>
    <a class="dropdown-item" href="@lng/auth/logout">
      @lang('auth.logout')
    </a>
  </details-menu>
</details>
