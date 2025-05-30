<?php /** @var \App\Comment $comment */ ?>

@extends('magnets.base')

@section('content')
<h3 class="font-medium text-2xl mb-2">Последние комментарии</h3>
@foreach ($comments as $comment)
  <a id="comment-{{ $comment->id }}"></a>
  <div class="flex py-4 w-full border-b border-grey-200 dark:border-slate-700">
    <aside class="mr-4 md:mr-6">
        @if ($comment->user)
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
        @endif
    </aside>
    <div class="break-words max-w-[700px] w-full">
      <div>
        @if ($comment->user)
          <a href="{{ $comment->user->www() }}">{{ $comment->user->publicName() }}</a>
        @else
          <em>deleted user</em>
        @endif
        <span class="mx-2 text-gray-500">&middot;</span>
        @if ($comment->rel?->status === App\Domain\MagnetStatus::Published)
          <a href="{{ $comment->rel->www() }}#comment-{{ $comment->id }}">{{ Str::limit($comment->rel->title, 50) }}</a>
        @else
          <em class="text-gray-500">раздача удалена</em>
        @endif
      </div>
      <div class="comment-body whitespace-pre-line">{!! $comment->html !!}</div>
      <div class="text-xs text-gray-500">{{ $comment->fullDate() }}</div>
    </div>
  </div>
@endforeach
@endsection
