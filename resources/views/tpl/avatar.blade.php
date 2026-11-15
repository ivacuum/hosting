<?php /** @var \App\Models\User $user */ ?>
@if ($user?->avatar)
  <img class="inline-block align-middle rounded-full {{ $classes ?? 'w-12 h-12' }}" src="{{ $user->avatarUrl() }}" alt="">
@else
  @include('tpl.svg-avatar', [
    'bg' => ViewHelper::avatarBg($user->id),
    'text' => $user->avatarName(),
    'classes' => $classes ?? null,
  ])
@endif
