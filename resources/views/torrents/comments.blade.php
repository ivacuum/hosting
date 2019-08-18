@extends('torrents.base')

@section('content')
<h3>Последние комментарии</h3>
@foreach ($comments as $comment)
  <a id="comment-{{ $comment->id }}"></a>
  <div class="d-flex py-3 w-100 border-bottom">
    <aside class="mr-3 mr-md-4">
        @if (null !== $comment->user)
          <div class="comment-avatar-size tw-mt-1">
            <a href="{{ $comment->user->www() }}">
              @if ($comment->user->avatar)
                <img class="comment-avatar-size rounded-circle" src="{{ $comment->user->avatarUrl() }}">
              @else
                @include('tpl.svg-avatar', [
                  'bg' => ViewHelper::avatarBg($comment->user_id),
                  'text' => $comment->user->avatarName(),
                ])
              @endif
            </a>
          </div>
        @endif
    </aside>
    <div class="text-break-word mw-700 w-100">
      <div>
        @if (null !== $comment->user)
          <a href="{{ $comment->user->www() }}">{{ $comment->user->publicName() }}</a>
        @else
          <em>deleted user</em>
        @endif
        <span class="mx-2 text-muted">&middot;</span>
        @if (optional($comment->rel)->status === App\Torrent::STATUS_PUBLISHED)
          <a href="{{ $comment->rel->www() }}#comment-{{ $comment->id }}">{{ Illuminate\Support\Str::limit($comment->rel->title, 50) }}</a>
        @else
          <em class="text-muted">раздача удалена</em>
        @endif
      </div>
      <div class="comment-body pre-line">{!! $comment->html !!}</div>
      <div class="small text-muted">{{ $comment->fullDate() }}</div>
    </div>
  </div>
@endforeach
@endsection
