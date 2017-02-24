@extends('torrents.base')

@section('content')
<h3 class="mt-0">Последние комментарии</h3>
@foreach ($comments as $comment)
  <div class="comment-container">
    <a name="comment-{{ $comment->id }}"></a>
    <div class="comment-content">
      <aside class="comment-author-container">
        <div class="comment-author">
          @if (!is_null($comment->user))
            <div class="comment-author-avatar">
              @if ($comment->user->avatar)
                <img class="comment-author-avatar-image" src="{{ $comment->user->avatarUrl() }}">
              @else
                @include('tpl.svg-avatar', [
                  'bg' => ViewHelper::avatarBg($comment->user_id),
                  'text' => $comment->user->avatarName(),
                ])
              @endif
            </div>
          @endif
          <div class="comment-author-details">
            <span class="comment-author-name">
              @if (!is_null($comment->user))
                {{ $comment->user->publicName() }}
              @else
                <em>deleted user</em>
              @endif
            </span>
          </div>
        </div>
      </aside>
      <div class="comment-body-container">
        <div class="comment-meta">
          {{ $comment->fullDate() }}
        </div>
        <div class="comment-body">
          <div class="mb-3">
            <a class="link" href="{{ action('Torrents@torrent', $comment->rel_id) }}#comment-{{ $comment->id }}">{{ str_limit($comment->rel->title, 80) }}</a>
          </div>
          {!! nl2br($comment->html) !!}
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection
