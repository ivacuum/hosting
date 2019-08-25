@extends('life.base')

@section('content')
<h1 class="tw-text-3xl">{{ trans('life.calendar') }}</h1>
<ul class="list-inline tw-text-sm">
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><mark>{{ trans('life.by_days') }}</mark></li>
</ul>

@if ($firstDate !== null && $lastDate !== null)
  @ru
    <p>Поездки по дням. Несколько флагов в один день означают несколько посещенных городов: как переезды, так и поездки одним днем туда-обратно. Каждый флаг является ссылкой на соответствующую историю, если она уже опубликована.</p>
  @en
    <p>Trips by days. Several flags in one cell means there were multiple cities visited during that day: moving from one place to another or just one-day trips. Each flag is a link to the story about the trip if the story is published.</p>
  @endru
  <div class="calendar-grid tw-text-2xs md:tw-text-sm tw-text-center">
    @foreach (range($lastDate->year, $firstDate->year, -1) as $year)
      <div class="tw-font-bold tw-text-right tw-mt-4 tw-pr-2 tw-bg-gray-300">{{ $year }}</div>
      @foreach (range(1, 31) as $day)
        <div class="tw-mt-4 tw-bg-gray-300">{{ $day }}</div>
      @endforeach
      @foreach (range($year === $lastDate->year ? $lastDate->month : 12, 1, -1) as $month)
        <div class="tw-text-right tw-pr-2 border-right">{{ trans("months.{$month}") }}</div>
        @foreach (range(1, 31) as $day)
          @php ($date = "{$year}-{$month}-{$day}")
          @if (isset($calendar[$date]))
            <div class="tw-bg-light tw-flex tw-flex-col tw-items-center tw-justify-start tw-pt-1 tw-shadow-inner">
              @foreach ($calendar[$date] as $trip)
                @if ($trip['slug'])
                  <a class="tw-block tw-pb-1 tooltipped tooltipped-n" href="{{ $trip['slug'] }}" aria-label="{{ $trip['title'] }}">
                    <img class="tw-block flag-16 svg-shadow" src="{{ $trip['flag'] }}">
                  </a>
                @else
                  <div class="tw-pb-1">
                    <img class="tw-block flag-16 svg-shadow" src="{{ $trip['flag'] }}">
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
  <h3 class="tw-mt-12">
    @ru
      Количество посещенных стран и городов
    @en
      Number of countries and cities visited
    @endru
  </h3>
  <div class="tw-flex">
    <div class="tw-mr-6">
      <div class="tw-font-bold tw-text-right">@ru Год @en Year @endru</div>
      @foreach ($daysInTrips as $year => $days)
        <div>{{ $year }}</div>
      @endforeach
    </div>
    <div class="tw-mr-6">
      <div class="tw-font-bold tw-text-right">@ru Дни @en Days @endru</div>
      @foreach ($daysInTrips as $year => $days)
        <div class="tw-text-right">{{ $days }}</div>
      @endforeach
    </div>
    <div class="tw-mr-6">
      <div class="tw-font-bold tw-text-right">@ru Города @en Cities @endru</div>
      @foreach ($cities as $year => $count)
        <div class="tw-text-right">
          {{ $count }}
          @if (isset($newCities[$year]))
            (+{{ $newCities[$year] }})
          @endif
        </div>
      @endforeach
    </div>
    <div>
      <div class="tw-font-bold tw-text-right">@ru Страны @en Countries @endru</div>
      @foreach ($countries as $year => $count)
        <div class="tw-text-right">
          {{ $count }}
          @if (isset($newCountries[$year]))
            (+{{ $newCountries[$year] }})
          @endif
        </div>
      @endforeach
    </div>
  </div>
@else
  @ru
    <p>Поездок еще нет.</p>
  @en
    <p>There are no trips yet.</p>
  @endru
@endif
@endsection
