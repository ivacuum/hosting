@extends('photos.base')

@section('content')
<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($tags as $tag)
    @php ($current_initial = $tag->initial())
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $current_initial)
        <span class="absolute font-bold uppercase -ml-6">{{ $current_initial }}</span>
      @endif
      <a class="link" href="{{ path('Photos@tag', $tag) }}">#{{ $tag->title }}</a>
      <span class="text-xs text-muted">{{ $tag->photos_published_count }}</span>
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
