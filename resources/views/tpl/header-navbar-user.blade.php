<li class="nav-item {{ $self == 'Notifications' ? 'active' : '' }}">
  <a class="nav-link position-relative tooltipped tooltipped-s" href="{{ path('Notifications@index') }}" aria-label="{{ trans('notifications.index') }}">
    <span class="{{ !is_null(Auth::user()->unreadNotifications()->first()) ? 'has-unread-label' : '' }}">
      @svg (bell)
    </span>
  </a>
</li>
<li class="nav-item dropdown dropdown-hover">
  <a class="nav-link dropdown-toggle avatar-dropdown" href="#" data-toggle="dropdown">
    @include('tpl.avatar', ['user' => Auth::user()])
  </a>
  <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header">
      {{ trans('auth.signed_in_as') }}
      <span class="font-weight-bold">{{ Auth::user()->displayName() }}</span>
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
</li>
