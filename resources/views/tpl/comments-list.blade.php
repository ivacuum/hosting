<div class="h3 mt-5">
  {{ trans('comments.discussion') }}
  <small>{{ $comments->total() }}</small>
</div>
<a name="comments"></a>
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
        {{--
        <aside class="comment-controls">
          <button class="btn btn-default btn-sm">
            @svg (angle-down)
          </button>
        </aside>
        --}}
        <div class="comment-meta">{{ $comment->fullDate() }}</div>
        <div class="comment-body">{!! nl2br($comment->html) !!}</div>
      </div>
    </div>
  </div>
@endforeach
