<li>
  <a class="tooltipped tooltipped-s {{ $self == 'Notifications' ? 'navbar-selected' : '' }}" href="{{ path('Notifications@index') }}" aria-label="{{ trans('notifications.index') }}">
    @svg (bell)
    <span class="counter-label-round">{{ !is_null(Auth::user()->unreadNotifications()->first()) ? '!' : '' }}</span>
  </a>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle avatar-dropdown" data-toggle="dropdown">
    @include('tpl.avatar', ['user' => Auth::user()])
    @svg (angle-down)
  </a>
  <ul class="dropdown-menu">
    <li class="dropdown-header">
      {{ trans('auth.signed_in_as') }}
      <span class="font-bold">{{ Auth::user()->displayName() }}</span>
    </li>
    <li class="divider"></li>
    @if (Auth::user()->isAdmin())
      <li>
        <a href="{{ App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips" }}">
          {{ trans('acp.index') }}
        </a>
      </li>
    @endif
    <li>
      <a href="{{ path('My@profile') }}">
        {{ trans('my.index') }}
      </a>
    </li>
    <li class="divider"></li>
    <li>
      <a href="{{ path('Auth@logout') }}">
        {{ trans('auth.logout') }}
      </a>
    </li>
  </ul>
</li>
