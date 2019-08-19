@extends('acp.list')

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <th class="md:tw-text-right">#</th>
    <th>Клиент</th>
    <th>Почта</th>
    <th>Комментарии</th>
  </tr>
  </thead>
  @foreach ($models as $model)
  <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
    <td class="md:tw-text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
    <td>
      <a href="{{ path("$self@show", $model) }}">
        {{ $model->name }}
      </a>
    </td>
    <td>{{ $model->email }}</td>
    <td class="pre-line">{{ Illuminate\Support\Str::limit($model->text, 100) }}</td>
  </tr>
  @endforeach
</table>
@endsection
