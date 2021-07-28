@extends('acp.list')

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <th>Клиент</th>
    <th>Почта</th>
    <th>Комментарии</th>
  </tr>
  </thead>
  @foreach ($models as $model)
  <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
    <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
    <td>
      <a href="{{ path([$controller, 'show'], $model) }}">
        {{ $model->name }}
      </a>
    </td>
    <td>{{ $model->email }}</td>
    <td class="whitespace-pre-line">{{ Str::limit($model->text, 101) }}</td>
  </tr>
  @endforeach
</table>
@endsection
