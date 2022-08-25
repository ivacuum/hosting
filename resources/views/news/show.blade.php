<?php
/**
 * @var \App\News $news
 */
?>

@extends('base')
@include('livewire')

@section('content')
<article itemscope itemtype="https://schema.org/BlogPosting">
  <header>
    <h1 class="font-medium text-3xl tracking-tight mb-2" itemprop="headline">{{ $news->title }}</h1>
    <link href="{{ $news->www() }}" itemprop="url">
    <div class="svg-labels svg-muted text-muted text-sm mb-4">
      <span class="svg-flex svg-label">
        @svg (calendar-o)
        <time itemprop="datePublished" datetime="{{ $news->created_at->toDateString() }}">
          {{ $news->created_at->isoFormat('LL') }}
        </time>
      </span>
      @if ($news->user->login)
        <span class="svg-flex svg-label">
          @svg (pencil)
          {{ $news->user->login }}
        </span>
      @endif
      <span class="svg-flex svg-label">
        @svg (eye)
        {{ ViewHelper::number($news->views) }}
      </span>
    </div>
  </header>
  <div class="antialiased hanging-punctuation-first lg:text-lg markdown-body break-words" itemprop="articleBody">{!! $news->html !!}</div>
</article>

@livewire(App\Http\Livewire\Comments::class, ['model' => $news])
@livewire(App\Http\Livewire\CommentAddForm::class, ['model' => $news])
@endsection
