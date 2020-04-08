<div class="h3 mt-12">
  {{ trans('comments.discussion') }}
  <span class="text-base text-muted">{{ sizeof($comments) }}</span>
</div>
<a id="comments"></a>
@foreach ($comments as $comment)
  <a id="comment-{{ $comment->id }}"></a>
  <div class="flex py-4 w-full border-b border-grey-200">
    <aside class="mr-4 md:mr-6">
      @if (null !== $comment->user)
        <div class="comment-avatar-size mt-1">
          <a href="{{ $comment->user->www() }}">
            @if ($comment->user->avatar)
              <img class="comment-avatar-size rounded-full" src="{{ $comment->user->avatarUrl() }}" alt="">
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
    <div class="break-words max-w-700px w-full">
      <div>
        @if (null !== $comment->user)
          <a href="{{ $comment->user->www() }}">{{ $comment->user->publicName() }}</a>
        @else
          <em>deleted user</em>
        @endif
      </div>
      <div class="comment-body whitespace-pre-line">{!! $comment->html !!}</div>
      <div class="small text-muted">{{ $comment->fullDate() }}</div>
    </div>
  </div>
@endforeach
