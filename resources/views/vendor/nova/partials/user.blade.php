<dropdown-trigger class="h-9 flex items-center">
    @include('tpl.avatar', ['classes' => 'w-8 h-8 mr-3'])

    <span class="text-90">
        {{ $user->login ?? $user->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
          <a href="{{ path(App\Http\Controllers\HomeController::class) }}" class="block no-underline text-90 hover:bg-30 p-3">
            @lang('Home')
          </a>
        </li>
        <li>
          <a href="{{ path([App\Http\Controllers\Acp\Home::class, 'index']) }}" class="block no-underline text-90 hover:bg-30 p-3">
            ACP
          </a>
        </li>
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                @lang('Logout')
            </a>
        </li>
    </ul>
</dropdown-menu>
