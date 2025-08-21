@extends('user-travel.base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">
  @lang('Посещенные города')
  <span class="text-base text-gray-500">{{ count($cities) }}</span>
</h1>
<x-user-trips-subnav/>

<div class="column-width-48">
  <?php $initial = $currentInitial = false ?>
  <?php /** @var \App\Domain\Life\Models\City $city */ ?>
  @foreach ($cities as $city)
    <?php $currentInitial = $city->initial() ?>
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $currentInitial)
        <span class="absolute font-bold uppercase -ml-6">{{ $currentInitial }}</span>
      @endif
      @if ($city->trips_published_count)
        <a class="link" href="{{ to('@{login}/travel/cities/{city}', [$traveler->login, $city->slug]) }}">{{ $city->title }}</a>
      @else
        {{ $city->title }}
      @endif
      @if ($city->trips_count > 1)
        <span class="text-xs text-gray-500">{{ $city->trips_count }}</span>
      @endif
    </div>
    <?php $initial = $currentInitial ?>
  @endforeach
</div>
@endsection
