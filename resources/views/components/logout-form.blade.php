<form action="{{ to('auth/logout') }}" method="post" {{ $attributes }}>
  @csrf
  {{ $slot }}
</form>
