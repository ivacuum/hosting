@extends('base')

@section('content')
<div class="md:tw-flex md:tw--mx-4">
  <div class="md:tw-w-1/3 md:tw-px-4">
    <div class="tw-text-center">
      @include('tpl.avatar')
      <h1 class="h3 tw-mt-2">{{ $user->publicName() }}</h1>
    </div>
    <table class="tw-mx-auto tw-mb-4 tw-break-words">
      <tr>
        <td class="text-muted tw-text-right tw-pr-1">Зарегистрирован</td>
        <td class="tw-pl-1 tw-mb-2">{{ ViewHelper::dateShort($user->created_at) }}</td>
      </tr>
      <tr>
        <td class="text-muted tw-text-right tw-pr-1">Последний вход</td>
        <td class="tw-pl-1 tw-mb-2">{{ ViewHelper::dateShort($user->last_login_at) }}</td>
      </tr>
      @if ($user->comments_count)
        <tr>
          <td class="text-muted tw-text-right tw-pr-1">Комментарии</td>
          <td class="tw-pl-1 tw-mb-2">{{ ViewHelper::number($user->comments_count) }}</td>
        </tr>
      @endif
      @if ($user->images_count)
        <tr>
          <td class="text-muted tw-text-right tw-pr-1">В галерее</td>
          <td class="tw-pl-1 tw-mb-2">{{ ViewHelper::plural('photos', $user->images_count) }}</td>
        </tr>
      @endif
      @if ($user->torrents_count)
        <tr>
          <td class="text-muted tw-text-right tw-pr-1">Раздачи</td>
          <td class="tw-pl-1 tw-mb-2">{{ ViewHelper::number($user->torrents_count) }}</td>
        </tr>
      @endif
    </table>
    @if (optional(Auth::user())->id === $user->id)
      <div>
        <a class="btn btn-default btn-block" href="{{ path('MyProfile@edit') }}">{{ trans('my.edit_profile') }}</a>
      </div>
    @endif
  </div>
</div>
@endsection
