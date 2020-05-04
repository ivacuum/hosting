<a
  class="border-b-2 border-transparent -mb-2px px-2 py-3 text-2xl text-grey-600 hover:text-grey-900 leading-none relative tooltipped tooltipped-s {{ $controller === App\Http\Controllers\Notifications::class ? 'border-blueish-500 text-grey-900' : '' }}"
  href="{{ path([App\Http\Controllers\Notifications::class, 'index']) }}"
  aria-label="{{ trans('notifications.index') }}"
>
  <span class="{{ null !== Auth::user()->unreadNotifications()->first() ? 'has-unread-label' : '' }}">
    @svg (bell)
  </span>
</a>
<div class="dropdown dropdown-hover flex items-center">
  <a
    class="flex items-center px-2 py-1 text-grey-600 hover:text-grey-900 dropdown-toggle"
    href="#"
    data-toggle="dropdown"
  >
    @include('tpl.avatar', ['user' => Auth::user(), 'classes' => 'w-8 h-8'])
  </a>
  <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header">
      {{ trans('auth.signed_in_as') }}
      <span class="font-bold">{{ Auth::user()->displayName() }}</span>
    </div>
    <div class="dropdown-divider"></div>
    @if (Auth::user()->isAdmin())
      <a
        class="dropdown-item-tw"
        href="{{ App::isLocal() ? path([App\Http\Controllers\Acp\Dev\Templates::class, 'index']) : path([App\Http\Controllers\Acp\Trips::class, 'index'], ['user_id' => 1]) }}"
      >
        {{ trans('acp.index') }}
      </a>
      <a
        class="dropdown-item-tw"
        href="/nova">
        Nova
      </a>
    @endif
    <a class="dropdown-item-tw" href="{{ path([App\Http\Controllers\MyProfile::class, 'edit']) }}">
      {{ trans('my.index') }}
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item-tw" href="{{ path([App\Http\Controllers\Auth\SignIn::class, 'logout']) }}">
      {{ trans('auth.logout') }}
    </a>
  </div>
</div>
