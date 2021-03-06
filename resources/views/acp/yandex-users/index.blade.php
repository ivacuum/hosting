@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <th>Аккаунт</th>
    <th class="md:text-right">Доменов</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ path([$controller, 'show'], $model) }}">
          {{ $model->account }}
        </a>
      </td>
      <td class="md:text-right">{{ sizeof($model->domains) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
