@extends('life.base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="@lang('Заметки')" href="{{ url(to('life/rss')) }}">
@endpush

@section('content')
<div class="grid md:grid-cols-2 gap-8">
  <section class="pt-0">
    <div class="flex flex-wrap gap-4 items-center mb-1">
      <h1 class="font-medium text-3xl tracking-tight mb-1">@lang('Поездки')</h1>
      @if (Auth::check())
        <form action="@lng/subscriptions" method="post">
          {{ ViewHelper::inputHiddenMail() }}
          <button class="btn btn-default leading-none text-sm small-caps svg-flex svg-label">
            @svg (mail)
            {{ Auth::user()->notify_trips ? __('mail.unsubscribe') : __('mail.subscribe') }}
          </button>
          <input type="hidden" name="trips" value="{{ Auth::user()->notify_trips ? App\Domain\NotificationDeliveryMethod::Disabled->value : App\Domain\NotificationDeliveryMethod::Mail->value }}">
          @method('put')
          @csrf
        </form>
      @else
        <a class="btn btn-default leading-none text-sm svg-flex svg-label small-caps" href="@lng/subscriptions?trips=1">
          @svg (mail)
          @lang('mail.subscribe')
        </a>
      @endif
      <a class="svg-flex svg-label small-caps" href="@lng/life/rss">
        @svg (rss-square)
        rss
      </a>
    </div>
    <x-trips-subnav/>

    @include('tpl.trips_by_years')
  </section>
  <section class="md:pt-0">
    <h2 class="font-medium text-3xl tracking-tight mb-2">@lang('Избранное')</h2>
    <nav class="space-y-2">
      @ru
        <div><a class="link" href="@lng/life/chillout">Chillout</a></div>
        <div><a class="link" href="@lng/life/books">Книги</a></div>
      @endru
      <div><a class="link" href="@lng/life/gigs">@lang('Концерты')</a></div>
      @ru
        <div><a class="link" href="@lng/life/favorite-posts">Любимые посты</a></div>
        <div><a class="link" href="@lng/life/podcasts">Подкасты</a></div>
        <div><a class="link" href="@lng/life/laundry">Условные обозначения стирки</a></div>
        <div><a class="link" href="@lng/life/movies">Фильмы и сериалы</a></div>
        <div><a class="link" href="@lng/life/using-in-travels">Чем пользуюсь в путешествиях</a></div>
      @endru
    </nav>

    <h2 class="font-medium text-3xl tracking-tight mb-2 mt-12">@lang('Языки')</h2>
    <nav class="space-y-2">
      <div><a class="link" href="@lng/life/english">@lang('Английский')</a></div>
      @ru
        <div><a class="link" href="@lng/life/german">@lang('Немецкий')</a></div>
      @endru
      <div><a class="link" href="@lng/japanese">@lang('Японский')</a></div>
    </nav>
  </section>
</div>
@endsection
