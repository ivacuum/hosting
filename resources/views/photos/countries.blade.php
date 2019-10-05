@extends('photos.base')

@section('content')
<div class="cities-columns">
  <?php $initial = $currentInitial = false ?>
  <?php /** @var App\Country $country */ ?>
  @foreach ($countries as $country)
    <?php $currentInitial = $country->initial() ?>
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $currentInitial)
        <span class="absolute font-bold uppercase -ml-6">{{ $currentInitial }}</span>
      @endif
      <a class="link" href="{{ path('Photos@country', $country->slug) }}">{{ $country->title }}</a>
    </div>
    <?php $initial = $currentInitial ?>
  @endforeach
</div>
@endsection
