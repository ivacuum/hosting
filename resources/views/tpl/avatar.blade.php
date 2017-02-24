@if (is_object($user) && $user->avatar)
  <img class="avatar-100" src="{{ $user->avatarUrl() }}">
@else
  @include('tpl.svg-avatar', [
    'bg' => ViewHelper::avatarBg($user->id),
    'text' => $user->avatarName(),
  ])
@endif
