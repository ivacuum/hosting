@extends('base')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="text-center">
      @include('tpl.avatar')
      <h1 class="h3 tw-mt-2">{{ $user->publicName() }}</h1>
    </div>
    <dl class="dl-table dt-gray tw-mx-auto">
      <dt>Зарегистрирован</dt>
      <dd>{{ ViewHelper::dateShort($user->created_at) }}</dd>
      <dd class="d-table-row"></dd>
      <dt>Последний вход</dt>
      <dd>{{ ViewHelper::dateShort($user->last_login_at) }}</dd>
      @if ($user->comments_count)
        <dd class="d-table-row"></dd>
        <dt>Комментарии</dt>
        <dd>{{ ViewHelper::number($user->comments_count) }}</dd>
      @endif
      @if ($user->images_count)
        <dd class="d-table-row"></dd>
        <dt>В галерее</dt>
        <dd>{{ ViewHelper::plural('photos', $user->images_count) }}</dd>
      @endif
      @if ($user->torrents_count)
        <dd class="d-table-row"></dd>
        <dt>Раздачи</dt>
        <dd>{{ ViewHelper::number($user->torrents_count) }}</dd>
      @endif
    </dl>
    @if (optional(Auth::user())->id === $user->id)
      <div>
        <a class="btn btn-default btn-block" href="{{ path('MyProfile@edit') }}">{{ trans('my.edit_profile') }}</a>
      </div>
    @endif
  </div>
  <div class="col-md-8"></div>
</div>
@endsection
