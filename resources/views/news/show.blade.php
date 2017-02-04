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

@include('tpl.comments-list')

@if (Auth::check())
  @include('tpl.comment-add', ['params' => ['news', $news->id]])
@endif

@if ($comments->total())
  <div class="m-t-1 text-center">
    @include('tpl.paginator', ['paginator' => $comments])
  </div>
@endif
@endsection
