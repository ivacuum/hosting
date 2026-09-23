@extends('life.base')

@section('content_header')
@parent
<div class="max-w-[1000px] mx-auto">
  @include('tpl.city-timeline')
  <div class="flex flex-wrap gap-2 items-center mb-2">
    <img class="flag-24 svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="" loading="lazy">
    <h1 class="font-medium text-3xl tracking-tight mb-1">{{ $trip->title }}</h1>
    @include('tpl.city-map-button', ['city' => $trip->city])
    @if (Auth::user()?->isRoot())
      <a class="btn btn-default text-sm py-1" href="{{ Acp::edit($trip) }}">
        @svg (pencil)
      </a>
    @endif
  </div>
  <time datetime="{{ $trip->date_start->toDateString() }}"></time>
  <div id="trip_city_map" class="mb-4 hidden -mx-4 sm:mx-0 h-[50vh]"></div>

  <article class="js-trip-shortcuts">
@endsection

@section('content_footer')
  </article>
</div>

@include('tpl.trips-timeline')

<div class="font-medium text-xl mt-6 mb-2">@ru Поделиться ссылкой @en Share @endru</div>
@include('tpl.social-buttons', ['title' => $trip->metaTitle(), 'url' => Request::url()])

@parent

@if (isset($comments))
  @livewire(App\Livewire\Comments::class, ['model' => $trip])
  @livewire(App\Livewire\CommentAddForm::class, ['model' => $trip])
@endif
@endsection
