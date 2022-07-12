@extends('life.base')

@section('content')
<h1 class="text-3xl tracking-tight">@lang('Календарь поездок')</h1>
<x-trips-subnav/>

@if ($firstDate !== null && $lastDate !== null)
  @ru
    <p>Поездки по дням. Несколько флагов в один день означают несколько посещенных городов: как переезды, так и поездки одним днем туда-обратно. Каждый флаг является ссылкой на соответствующую историю, если она уже опубликована.</p>
  @en
    <p>Trips by days. Several flags in one cell means there were multiple cities visited during that day: moving from one place to another or just one-day trips. Each flag is a link to the story about the trip if the story is published.</p>
  @endru
  <div class="grid overflow-x-scroll text-2xs md:text-sm text-center" style="grid-template-columns: max-content repeat(31, minmax(18px, 1fr));">
    <?php /** @var int $year */ ?>
    @foreach (range($lastDate->year, $firstDate->year, -1) as $year)
      <div id="year-{{ $year }}" class="font-bold text-right mt-4 pr-2 bg-grey-200 dark:bg-slate-800">{{ $year }}</div>
      @foreach (range(1, 31) as $day)
        <div class="mt-4 bg-grey-200 dark:bg-slate-800">{{ $day }}</div>
      @endforeach
      <?php /** @var int $month */ ?>
      @foreach (range($year === $lastDate->year ? $lastDate->month : 12, 1, -1) as $month)
        <div class="text-right pr-2 border-r border-grey-200 dark:border-slate-800">{{ now()->startOfMonth()->setMonth($month)->isoFormat('MMMM') }}</div>
        <?php /** @var int $day */ ?>
        @foreach (range(1, 31) as $day)
          <?php $date = "{$year}-{$month}-{$day}" ?>
          @if (isset($calendar[$date]))
            <div class="bg-light dark:bg-slate-800 flex flex-col items-center justify-start pt-1 shadow-inner">
              @foreach ($calendar[$date] as $trip)
                @if ($trip['slug'])
                  <a class="block pb-1 tooltipped tooltipped-n" href="{{ $trip['slug'] }}" aria-label="{{ $trip['title'] }}">
                    <img class="block flag-16 svg-shadow" src="{{ $trip['flag'] }}" alt="">
                  </a>
                @else
                  <div class="pb-1 tooltipped tooltipped-n" aria-label="{{ $trip['title'] }}">
                    <img class="block opacity-50 flag-16 svg-shadow" src="{{ $trip['flag'] }}" alt="">
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
  <div class="flex gap-6">
    <div>
      <div class="font-bold text-right">@ru Год @en Year @endru</div>
      @foreach ($daysInTrips as $year => $days)
        <div>{{ $year }}</div>
      @endforeach
    </div>
    <div>
      <div class="font-bold text-right">@ru Дни @en Days @endru</div>
      @foreach ($daysInTrips as $year => $days)
        <div class="text-right">{{ $days }}</div>
      @endforeach
    </div>
    <div>
      <div class="font-bold text-right">@ru Города @en Cities @endru</div>
      @foreach ($daysInTrips as $year => $null)
        <div class="text-right">
          @if (isset($cities[$year]))
              {{ $cities[$year] }}
              @if (isset($newCities[$year]))
                (+{{ $newCities[$year] }})
              @endif
          @else
            &nbsp;
          @endif
        </div>
      @endforeach
    </div>
    <div>
      <div class="font-bold text-right">@ru Страны @en Countries @endru</div>
      @foreach ($daysInTrips as $year => $null)
        <div class="text-right">
          @if (isset($countries[$year]))
            {{ $countries[$year] }}
            @if (isset($newCountries[$year]))
              (+{{ $newCountries[$year] }})
            @endif
          @else
            &nbsp;
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
