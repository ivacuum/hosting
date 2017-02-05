@extends('base')

@section('content')
<h3>{{ $news->title }}</h3>
<p class="text-muted">
  <span class="svg-muted mr-1">
    @svg (calendar-o)
  </span>
  {{ $news->created_at->formatLocalized('%e %B %Y') }}
  @if ($news->user->login)
    <span class="ml-3 mr-1 svg-muted">
      @svg (pencil)
    </span>
    {{ $news->user->login }}
  @endif
  <span class="ml-3 mr-1 svg-muted">
    @svg (eye)
  </span>
  {{ ViewHelper::number($news->views) }}
</p>
<div>{!! $news->html !!}</div>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['news', $news->id]])

@if ($comments->hasPages())
  <div class="mt-1 text-center">
    @include('tpl.paginator', ['paginator' => $comments])
  </div>
@endif
@endsection
