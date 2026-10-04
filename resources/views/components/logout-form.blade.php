<form action="{{ to('auth/logout') }}" method="post" {{ $attributes }}>
  {{ $slot }}
</form>
