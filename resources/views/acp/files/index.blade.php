@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">ID</th>
    <th>Название</th>
    <th class="text-right">Размер</th>
    <th class="text-right">&darr;</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-right">{{ $model->id }}</td>
      <td>
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td class="text-right text-muted">{{ ViewHelper::size($model->size) }}</td>
      <td class="text-right">{{ ViewHelper::number($model->downloads) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
