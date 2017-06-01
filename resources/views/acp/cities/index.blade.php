@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th></th>
    <th>Город</th>
    <th>URL</th>
    <th>IATA</th>
    <th class="text-right">@svg (eye)</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
        <td class="tooltipped tooltipped-n" aria-label="{{ $model->country->title }}">
          {{ $model->country->emoji }}
        </td>
        <td>
          <a href="{{ path("$self@show", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td>
          <a href="{{ $model->www() }}">
            {{ $model->slug }}
          </a>
        </td>
        <td>{{ $model->iata }}</td>
        <td class="text-right">
          @if ($model->views > 0)
            {{ ViewHelper::number($model->views) }}
          @endif
        </td>
        <td>
          @if ($model->lat && $model->lon)
            <span class="tooltipped tooltipped-n" aria-label="Геолокация задана">
              @svg (map-marker)
            </span>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
