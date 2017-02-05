@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats">
    <thead>
      <tr>
        <th></th>
        <th>Город</th>
        <th>URL</th>
        <th>IATA</th>
        <th></th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td class="tooltipped tooltipped-s" aria-label="{{ $model->country->title }}">
          {{ $model->country->emoji }}
        </td>
        <td>
          <a class="link" href="{{ action("$self@show", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td>
          <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
            {{ $model->slug }}
          </a>
        </td>
        <td>{{ $model->iata }}</td>
        <td>
          @if ($model->lat && $model->lon)
            <span class="tooltipped tooltipped-s" aria-label="Геолокация задана">
              @svg (map-marker)
            </span>
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
