@if (optional($user)->avatar)
  <img class="avatar-{{ $size ?? 100 }} tw-rounded-full" src="{{ $user->avatarUrl() }}">
@else
  @include('tpl.svg-avatar', [
    'bg' => ViewHelper::avatarBg($user->id),
    'text' => $user->avatarName(),
  ])
@endif
