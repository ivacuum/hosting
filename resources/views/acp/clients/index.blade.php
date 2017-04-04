@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>#</th>
    <th>Клиент</th>
    <th>Почта</th>
    <th>Комментарии</th>
  </tr>
  </thead>
  @foreach ($models as $model)
  <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
    <td>{{ $loop->iteration }}</td>
    <td>
      <a href="{{ path("$self@show", $model) }}" class="link">
        {{ $model->name }}
      </a>
    </td>
    <td>{{ $model->email }}</td>
    <td>{!! nl2br(str_limit($model->text, 100)) !!}</td>
  </tr>
  @endforeach
</table>
@endsection
