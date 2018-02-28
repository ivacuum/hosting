@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th></th>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'title', 'order' => 'asc'])
    </th>
    <th>URL</th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'cities_count'])
    </th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'trips_count'])
    </th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td><img class="d-block flag-16 flag-shadow" src="{{ $model->flagUrl() }}"></td>
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
      <td class="text-md-right">
        @if ($model->cities_count > 0)
          <a href="{{ path('Acp\Cities@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->cities_count) }}
          </a>
        @endif
      </td>
      <td class="text-md-right">
        @if ($model->trips_count > 0)
          <a href="{{ path('Acp\Trips@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->trips_count) }}
          </a>
        @endif
      </td>
      <td class="text-md-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
