@extends('base')

@section('content')
<div class="row">
  <div class="col-md-3 mb-3">
    <div class="text-center">
      @include('tpl.avatar')
      <h1 class="h3 mt-2">{{ $user->publicName() }}</h1>
    </div>
    <div>
      <span class="text-muted">Зарегистрирован</span>
      {{ ViewHelper::dateShort($user->created_at) }}
    </div>
    <div>
      <span class="text-muted">Последний вход</span>
      {{ ViewHelper::dateShort($user->last_login_at) }}
    </div>
    @if ($user->comments_count)
      <div>
        <span class="text-muted">Комментарии</span>
        {{ ViewHelper::number($user->comments_count) }}
      </div>
    @endif
    @if ($user->images_count)
      <div>
        <span class="text-muted">Изображения в галерее</span>
        {{ ViewHelper::number($user->images_count) }}
      </div>
    @endif
    @if ($user->torrents_count)
      <div>
        <span class="text-muted">Раздачи</span>
        {{ ViewHelper::number($user->torrents_count) }}
      </div>
    @endif
  </div>
  <div class="col-md-9">
  </div>
</div>
@endsection
