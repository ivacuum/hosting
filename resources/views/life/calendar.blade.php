@extends('life.base')

@section('content')
<h1 class="text-3xl">{{ trans('life.calendar') }}</h1>
<nav class="flex flex-wrap text-sm mb-4">
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></div>
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path('Life@countries') }}">{{ trans('life.by_country') }}</a></div>
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path('Life@cities') }}">{{ trans('life.by_city') }}</a></div>
  <div class="whitespace-no-wrap"><mark>{{ trans('life.by_days') }}</mark></div>
</nav>

@if ($firstDate !== null && $lastDate !== null)
  @ru
    <p>Поездки по дням. Несколько флагов в один день означают несколько посещенных городов: как переезды, так и поездки одним днем туда-обратно. Каждый флаг является ссылкой на соответствующую историю, если она уже опубликована.</p>
  @en
    <p>Trips by days. Several flags in one cell means there were multiple cities visited during that day: moving from one place to another or just one-day trips. Each flag is a link to the story about the trip if the story is published.</p>
  @endru
  <div class="calendar-grid text-2xs md:text-sm text-center">
    @foreach (range($lastDate->year, $firstDate->year, -1) as $year)
      <div class="font-bold text-right mt-4 pr-2 bg-gray-300">{{ $year }}</div>
      @foreach (range(1, 31) as $day)
        <div class="mt-4 bg-gray-300">{{ $day }}</div>
      @endforeach
      @foreach (range($year === $lastDate->year ? $lastDate->month : 12, 1, -1) as $month)
        <div class="text-right pr-2 border-right">{{ trans("months.{$month}") }}</div>
        @foreach (range(1, 31) as $day)
          @php ($date = "{$year}-{$month}-{$day}")
          @if (isset($calendar[$date]))
            <div class="bg-light flex flex-col items-center justify-start pt-1 shadow-inner">
              @foreach ($calendar[$date] as $trip)
                @if ($trip['slug'])
                  <a class="block pb-1 tooltipped tooltipped-n" href="{{ $trip['slug'] }}" aria-label="{{ $trip['title'] }}">
                    <img class="block flag-16 svg-shadow" src="{{ $trip['flag'] }}">
                  </a>
                @else
                  <div class="pb-1">
                    <img class="block flag-16 svg-shadow" src="{{ $trip['flag'] }}">
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
  <h3 class="mt-12">
    @ru
      Количество посещенных стран и городов
    @en
      Number of countries and cities visited
    @endru
  </h3>
  <div class="flex">
    <div class="mr-6">
      <div class="font-bold text-right">@ru Год @en Year @endru</div>
      @foreach ($daysInTrips as $year => $days)
        <div>{{ $year }}</div>
      @endforeach
    </div>
    <div class="mr-6">
      <div class="font-bold text-right">@ru Дни @en Days @endru</div>
      @foreach ($daysInTrips as $year => $days)
        <div class="text-right">{{ $days }}</div>
      @endforeach
    </div>
    <div class="mr-6">
      <div class="font-bold text-right">@ru Города @en Cities @endru</div>
      @foreach ($cities as $year => $count)
        <div class="text-right">
          {{ $count }}
          @if (isset($newCities[$year]))
            (+{{ $newCities[$year] }})
          @endif
        </div>
      @endforeach
    </div>
    <div>
      <div class="font-bold text-right">@ru Страны @en Countries @endru</div>
      @foreach ($countries as $year => $count)
        <div class="text-right">
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
