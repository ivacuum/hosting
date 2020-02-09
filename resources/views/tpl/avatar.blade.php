@if (optional($user)->avatar)
  <img class="inline-block avatar-{{ $size ?? 100 }} rounded-full {{ $classes ?? '' }}" src="{{ $user->avatarUrl() }}" alt="">
@else
  @include('tpl.svg-avatar', [
    'bg' => ViewHelper::avatarBg($user->id),
    'text' => $user->avatarName(),
    'classes' => $classes ?? null,
  ])
@endif
