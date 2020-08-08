<a
  class="border-b-2 border-transparent -mb-2px px-2 py-3 text-2xl text-grey-600 hover:text-grey-900 leading-none relative tooltipped tooltipped-s {{ $controller === App\Http\Controllers\Notifications::class ? 'border-blueish-500 text-grey-900' : '' }}"
  href="{{ path([App\Http\Controllers\Notifications::class, 'index']) }}"
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
      {{ trans('auth.signed_in_as') }}
      <span class="font-bold">{{ Auth::user()->displayName() }}</span>
    </div>
    <div class="h-0 my-2 overflow-hidden border-t border-gray-100"></div>
    @if (Auth::user()->isAdmin())
      <a
        class="dropdown-item"
        href="{{ App::isLocal() ? path([App\Http\Controllers\Acp\Dev\Templates::class, 'index']) : path([App\Http\Controllers\Acp\Trips::class, 'index'], ['user_id' => 1]) }}"
      >
        {{ trans('acp.index') }}
      </a>
      <a
        class="dropdown-item"
        href="/nova">
        Nova
      </a>
    @endif
    <a class="dropdown-item" href="{{ path([App\Http\Controllers\MyProfile::class, 'edit']) }}">
      {{ trans('my.index') }}
    </a>
    <div class="h-0 my-2 overflow-hidden border-t border-gray-100"></div>
    <a class="dropdown-item" href="{{ path([App\Http\Controllers\Auth\SignIn::class, 'logout']) }}">
      {{ trans('auth.logout') }}
    </a>
  </details-menu>
</details>
