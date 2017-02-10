@extends('torrents.base')

@section('content')
<h3 class="mt-0">Последние комментарии</h3>
@foreach ($comments as $comment)
  <div class="media mb-4">
    <div class="media-left">
      @include('tpl.svg-avatar', [
        'bg' => ViewHelper::avatarBg($comment->user_id),
        'text' => !is_null($comment->user) ? $comment->user->avatarName() : null,
      ])
    </div>
    <div class="media-body">
      <div class="h4 media-heading">
        @if (!is_null($comment->user))
          {{ $comment->user->publicName() }}
        @else
          <em>deleted user</em>
        @endif
        <span class="comment-meta">
          <span class="mx-1">&middot;</span>
          {{ $comment->fullDate() }}
          </span>
      </div>
      <div class="mt-1 mb-2">
        <a class="link" href="{{ action('Torrents@torrent', $comment->rel_id) }}">{{ str_limit($comment->rel->title, 80) }}</a>
      </div>
      <div>{!! nl2br($comment->html) !!}</div>
    </div>
  </div>
@endforeach
@endsection
