@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th></th>
    <th>Страна</th>
    <th>URL</th>
    <th class="text-right">@svg (eye)</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $model->emoji }}</td>
      <td>
        <a class="link" href="{{ path("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        <a class="link" href="{{ $model->www() }}">
          {{ $model->slug }}
        </a>
      </td>
      <td class="text-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
