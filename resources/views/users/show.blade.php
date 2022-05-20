<?php /** @var \App\User $user */ ?>

@extends('base')

@section('content')
<div class="md:w-1/3">
  <div>
    <div class="text-center">
      @include('tpl.avatar')
      <h1 class="h3 mt-2">{{ $user->publicName() }}</h1>
    </div>
    <table class="mx-auto mb-4 break-words">
      <tr>
        <td class="text-muted text-right pr-1">@lang('Дата регистрации')</td>
        <td class="pl-1 mb-2">{{ ViewHelper::dateShort($user->created_at) }}</td>
      </tr>
      <tr>
        <td class="text-muted text-right pr-1">@lang('Последний вход')</td>
        <td class="pl-1 mb-2">{{ ViewHelper::dateShort($user->last_login_at) }}</td>
      </tr>
      @if ($user->comments_count)
        <tr>
          <td class="text-muted text-right pr-1">@lang('Комментарии')</td>
          <td class="pl-1 mb-2">{{ ViewHelper::number($user->comments_count) }}</td>
        </tr>
      @endif
      @if ($user->images_count)
        <tr>
          <td class="text-muted text-right pr-1">@lang('В галерее')</td>
          <td class="pl-1 mb-2">{{ ViewHelper::plural('photos', $user->images_count) }}</td>
        </tr>
      @endif
      @if ($user->magnets_count)
        <tr>
          <td class="text-muted text-right pr-1">@lang('Магнеты')</td>
          <td class="pl-1 mb-2">{{ ViewHelper::number($user->magnets_count) }}</td>
        </tr>
      @endif
    </table>
    @if (Auth::user()?->id === $user->id)
      <div>
        <a
          class="btn btn-default block"
          href="@lng/my/profile"
        >@lang('Редактировать профиль')</a>
      </div>
    @endif
  </div>
</div>
@endsection
