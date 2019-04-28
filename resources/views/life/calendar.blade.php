@extends('life.base')

@section('content')
<h1 class="h2">{{ trans('life.calendar') }}</h1>
<ul class="list-inline f14">
  <li class="list-inline-item"><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item"><a class="link" href="{{ path('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
  <li class="list-inline-item"><a class="link" href="{{ path('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
  <li class="list-inline-item"><mark>{{ trans('life.by_days') }}</mark></li>
</ul>

@if (null !== $end && null !== $start)
  @ru
    <p>Поездки по дням. Несколько флагов в один день означают несколько посещенных городов: как переезды, так и поездки одним днем туда-обратно. Каждый флаг является ссылкой на соответствующую историю, если она уже опубликована.</p>
  @en
    <p>Trips by days. Several flags in one cell means there were multiple cities visited during that day: moving from one place to another or just one-day trips. Each flag is a link to the story about the trip if the story is published.</p>
  @endru
  <div class="calendar-grid text-center">
    @foreach (range($end->year, $start->year, -1) as $year)
      <div class="font-weight-bold text-right mt-3 pr-2 bg-gray-200">{{ $year }}</div>
      @foreach (range(1, 31) as $day)
        <div class="mt-3 bg-gray-200">{{ $day }}</div>
      @endforeach
      @foreach (range($year === $end->year ? $end->month : 12, 1, -1) as $month)
        <div class="text-right pr-2 border-right">{{ trans("months.{$month}") }}</div>
        @foreach (range(1, 31) as $day)
          @php ($date = "{$year}-{$month}-{$day}")
          @if (isset($calendar[$date]))
            <div class="bg-light d-flex flex-column align-items-center justify-content-start pt-1">
              @foreach ($calendar[$date] as $trip)
                @if ($trip['slug'])
                  <a class="d-block pb-1 tooltipped tooltipped-n" href="{{ $trip['slug'] }}" aria-label="{{ $trip['title'] }}">
                    <img class="d-block flag-16 flag-shadow" src="{{ $trip['flag'] }}">
                  </a>
                @else
                  <div class="pb-1">
                    <img class="d-block flag-16 flag-shadow" src="{{ $trip['flag'] }}">
                  </div>
                @endif
              @endforeach
            </div>
          @else
            <div></div>
          @endif
        @endforeach
      @endforeach
    @endforeach
  </div>
@else
  @ru
    <p>Поездок еще нет.</p>
  @en
    <p>There are no trips yet.</p>
  @endru
@endif
@endsection
