@if ($comments->total() || Auth::check())
  <div class="h3 m-t-3">
    {{ trans('comments.discussion') }}
    <small>{{ $comments->total() }}</small>
  </div>
@endif
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
