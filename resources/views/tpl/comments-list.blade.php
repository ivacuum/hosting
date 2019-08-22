<div class="h3 tw-mt-12">
  {{ trans('comments.discussion') }}
  <small class="text-muted">{{ sizeof($comments) }}</small>
</div>
<a id="comments"></a>
@foreach ($comments as $comment)
  <a id="comment-{{ $comment->id }}"></a>
  <div class="tw-flex tw-py-4 w-100 border-bottom">
    <aside class="tw-mr-4 md:tw-mr-6">
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
      @else
        <div class="comment-avatar-size"></div>
      @endif
    </aside>
    <div class="text-break-word mw-700 w-100">
      <div>
        @if (null !== $comment->user)
          <a href="{{ $comment->user->www() }}">{{ $comment->user->publicName() }}</a>
        @else
          <em>deleted user</em>
        @endif
      </div>
      <div class="comment-body pre-line">{!! $comment->html !!}</div>
      <div class="small text-muted">{{ $comment->fullDate() }}</div>
    </div>
  </div>
@endforeach
