@extends('photos.base')

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="text-center" style="position: relative;">
      @if (!is_null($prev))
        <a class="image-prev js-pjax js-pjax-no-dim" href="{{ action("$self@show", [$prev->id, 'tag_id' => $tag_id]) }}" style="position: absolute; top: 0; width: 50%; left: 0; height: 100%;">&nbsp;</a>
      @endif
      @if (!is_null($next))
        <a class="image-next js-pjax js-pjax-no-dim" href="{{ action("$self@show", [$next->id, 'tag_id' => $tag_id]) }}" style="position: absolute; top: 0; width: 50%; left: 50%; height: 100%;">&nbsp;</a>
      @endif
      <img class="screenshot" src="{{ $photo->originalUrl() }}">
    </div>
  </div>
  <div class="col-md-2">
    <div class="text-muted">{{ trans('photos.place') }}</div>
    <div>
      {{ $photo->rel->city->country->emoji }}
      <a class="link" href="{{ action('Life@page', $photo->rel->slug) }}#{{ basename($photo->slug) }}">{{ $photo->rel->title }}</a>
    </div>

    <div class="mt-3 text-muted">{{ trans('photos.date') }}</div>
    <div>{{ $photo->rel->period }} {{ $photo->rel->year }}</div>

    @if (sizeof($photo->tags))
      <div class="mt-3">
        <div class="text-muted">{{ trans('photos.tags') }}</div>
        @foreach ($photo->tags as $tag)
          <div>
            <a class="link" href="{{ action('Photos@tag', $tag) }}">#{{ $tag->title }}</a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endsection
