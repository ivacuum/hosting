@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-md-right">#</th>
    <th>Аккаунт</th>
    <th class="text-md-right">Доменов</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-md-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->account }}
        </a>
      </td>
      <td class="text-md-right">{{ sizeof($model->domains) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
