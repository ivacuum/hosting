@extends('base')

@section('content')
<h3>{{ $news->title }}</h3>
<p class="text-muted">
  <span class="svg-muted">
    @svg (calendar-o)
  </span>
  {{ $news->created_at->formatLocalized('%e %B %Y') }}
  @if ($news->user->login)
    <span class="p-l-1 svg-muted">
      @svg (pencil)
    </span>
    {{ $news->user->login }}
  @endif
  <span class="p-l-1 svg-muted">
    @svg (eye)
  </span>
  {{ ViewHelper::number($news->views) }}
</p>
<div>{!! $news->html !!}</div>

@if (Auth::check() && sizeof($comments))
  <h3 class="m-t-3">
    Обсуждение
    <small>{{ $comments->total() }}</small>
  </h3>
  @foreach ($comments as $comment)
    <div class="media">
      <div class="media-left">
        @include ('tpl.svg-avatar', [
          'bg' => ViewHelper::avatarBg($comment->user_id),
          'text' => !is_null($comment->user) ? $comment->user->avatarName() : null]
        )
      </div>
      <div class="media-body">
        <div class="h4 media-heading">
          @if (!is_null($comment->user))
            {{ $comment->user->publicName() }}
          @else
            <em>deleted user</em>
          @endif
          <span class="comment-meta">
            &nbsp;&middot;&nbsp;
            {{ $comment->fullDate() }}
          </span>
        </div>
        <div>{!! nl2br($comment->html) !!}</div>
      </div>
    </div>
  @endforeach

  <div class="m-t-1 text-center">
    @include('tpl.paginator', ['paginator' => $comments])
  </div>
@endif
@endsection
