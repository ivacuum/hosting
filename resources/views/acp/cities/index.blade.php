@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell"></div>
      <div class="flex-cell">Город</div>
      <div class="flex-cell">URL</div>
      <div class="flex-cell">IATA</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell tooltipped tooltipped-n" aria-label="{{ $model->country->title }}">
            {{ $model->country->emoji }}
          </div>
          <div class="flex-cell">
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->title }}
            </a>
          </div>
          <div class="flex-cell">
            <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
              {{ $model->slug }}
            </a>
          </div>
          <div class="flex-cell">{{ $model->iata }}</div>
          <div class="flex-cell">
            @if ($model->lat && $model->lon)
              <span class="tooltipped tooltipped-n" aria-label="Геолокация задана">
              @svg (map-marker)
            </span>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
@endsection
