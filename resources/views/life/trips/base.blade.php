@extends('life.base')
@include('livewire')

@section('content_header')
@parent
@include('tpl.city-timeline')
<div class="flex flex-wrap gap-2 items-center mb-2">
  <img class="flag-24 svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="">
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

<article class="max-w-[1000px] js-trip-shortcuts">
@endsection

@section('content_footer')
</article>

@include('tpl.trips-timeline')

<div class="font-medium text-xl mt-6 mb-2">@ru Поделиться ссылкой @en Share @endru</div>
@include('tpl.social-buttons', ['title' => $trip->metaTitle(), 'url' => Request::url()])

<div class="mt-6 py-3 px-5 text-teal-800 dark:text-teal-400 bg-teal-200/50 dark:bg-teal-400/25 border border-teal-200/50 rounded">
  <div class="mb-2">@lang('life.newsletter.description')</div>
  @if (Auth::check())
    @if (Auth::user()->notify_trips?->isDisabled())
      <form action="@lng/subscriptions" method="post">
        {{ ViewHelper::inputHiddenMail() }}
        <button class="btn btn-default text-sm py-1 small-caps svg-flex svg-label">
          @svg (mail)
          @lang('mail.subscribe')
        </button>
        <input type="hidden" name="trips" value="1">
        @method('put')
        @csrf
      </form>
    @endif
  @else
    <div class="flex">
      <a
        class="btn btn-default text-sm py-1 svg-flex svg-label small-caps mr-4"
        href="@lng/subscriptions?trips=1"
      >
        @svg (mail)
        @lang('mail.subscribe')
      </a>
    </div>
  @endif
</div>
@parent

@if (isset($comments))
  @livewire(App\Livewire\Comments::class, ['model' => $trip])
  @livewire(App\Livewire\CommentAddForm::class, ['model' => $trip])
@endif
@endsection
