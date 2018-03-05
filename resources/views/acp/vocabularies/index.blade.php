@extends('acp.list', [
  'search_form' => true,
])

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'character') }}</th>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'sentences') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $model->level }}</td>
      <td>
        <a class="bg-vocab d-block font-weight-bold pb-1 px-2 rounded text-center text-white" href="{{ path("$self@show", $model) }}">
          <span class="d-inline-block f36 ja-character ja-shadow">{{ $model->character }}</span>
        </a>
      </td>
      <td>{{ $model->meaning }}</td>
      <td>{{ !$model->sentences ? 'Нет' : '' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
