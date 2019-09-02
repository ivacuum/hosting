<a
  class="block border-b-2 border-transparent -mb-2px px-2 py-3 text-gray-600 hover:text-gray-900 relative tooltipped tooltipped-s {{ $self == 'Notifications' ? 'border-blue-500 text-gray-900' : '' }}"
  href="{{ path('Notifications@index') }}"
  aria-label="{{ trans('notifications.index') }}"
>
  <span class="leading-none text-xl {{ null !== Auth::user()->unreadNotifications()->first() ? 'has-unread-label' : '' }}">
    @svg (bell)
  </span>
</a>
<div class="dropdown dropdown-hover">
  <a class="flex items-center px-2 py-2 text-gray-600 hover:text-gray-900 dropdown-toggle" href="#" data-toggle="dropdown">
    @include('tpl.avatar', ['user' => Auth::user(), 'classes' => 'w-8 h-8'])
  </a>
  <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header">
      {{ trans('auth.signed_in_as') }}
      <span class="font-bold">{{ Auth::user()->displayName() }}</span>
    </div>
    <div class="dropdown-divider"></div>
    @if (Auth::user()->isAdmin())
      <a class="dropdown-item" href="{{ App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips?user_id=1" }}">
        {{ trans('acp.index') }}
      </a>
    @endif
    <a class="dropdown-item" href="{{ path('MyProfile@edit') }}">
      {{ trans('my.index') }}
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ path('Auth\SignIn@logout') }}">
      {{ trans('auth.logout') }}
    </a>
  </div>
</div>
