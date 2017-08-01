@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">#</th>
    <th>Клиент</th>
    <th>Почта</th>
    <th>Комментарии</th>
  </tr>
  </thead>
  @foreach ($models as $model)
  <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
    <td class="text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
    <td>
      <a href="{{ path("$self@show", $model) }}">
        {{ $model->name }}
      </a>
    </td>
    <td>{{ $model->email }}</td>
    <td>{!! nl2br(str_limit($model->text, 100)) !!}</td>
  </tr>
  @endforeach
</table>
@endsection
