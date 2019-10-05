@extends('photos.base')

@section('content')
<div class="cities-columns">
  <?php $initial = $currentInitial = false ?>
  <?php /** @var App\City $city */ ?>
  @foreach ($cities as $city)
    <?php $currentInitial = $city->initial() ?>
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $currentInitial)
        <span class="absolute font-bold uppercase -ml-6">{{ $currentInitial }}</span>
      @endif
      <a class="link" href="{{ path('Photos@city', $city->slug) }}">{{ $city->title }}</a>
    </div>
    <?php $initial = $currentInitial ?>
  @endforeach
</div>
@endsection
