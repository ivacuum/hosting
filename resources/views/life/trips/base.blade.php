@extends('life.base')
@include('livewire')

@section('content_header')
@parent
@include('tpl.city-timeline')
<div class="flex flex-wrap items-center mb-2">
  <img class="flag-24 svg-shadow mr-2" src="{{ $trip->city->country->flagUrl() }}" alt="">
  <h1 class="h2 tracking-tight mb-1 mr-2">{{ $trip->title }}</h1>
  @include('tpl.city-map-button', ['city' => $trip->city])
  @if (Auth::user()?->isRoot())
    <a class="btn btn-default text-sm py-1" href="{{ UrlHelper::edit(App\Http\Controllers\Acp\Trips::class, $trip) }}">
      @svg (pencil)
    </a>
  @endif
</div>
<time datetime="{{ $trip->date_start->toDateString() }}"></time>
<div id="trip_city_map" class="mb-4 hidden mobile-wide h-[50vh]"></div>

<article class="max-w-[1000px] js-trip-shortcuts">
@endsection

@section('content_footer')
</article>

@include('tpl.trips-timeline')

<div class="h4 mt-6">@ru Поделиться ссылкой @en Share @endru</div>
@include('tpl.social-buttons', ['title' => $trip->metaTitle(), 'url' => Request::url()])

@if (Auth::check())
  @if (!Auth::user()->notify_trips)
    <div class="mt-6 py-3 px-5 text-teal-800 bg-teal-200/50 border border-teal-200/50 rounded">
      <div class="mb-2">@lang('life.newsletter.description')</div>
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
    </div>
  @endif
@else
  <div class="mt-6 py-3 px-5 text-teal-800 bg-teal-200/50 border border-teal-200/50 rounded">
    <div class="mb-2">@lang('life.newsletter.description')</div>
    <div class="flex">
      <a
        class="btn btn-default text-sm py-1 svg-flex svg-label small-caps mr-4"
        href="@lng/subscriptions?trips=1"
      >
        @svg (mail)
        @lang('mail.subscribe')
      </a>
    </div>
  </div>
@endif
@parent

@if (isset($comments))
  @include('tpl.comments-list')
  @include('tpl.comment-add', ['params' => ['trip', $trip->id]])
@endif
@endsection
