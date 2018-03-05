@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'character') }}</th>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'kanjis_count'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $model->level }}</td>
      <td>
        <a class="bg-radical d-block font-weight-bold pb-1 px-2 rounded text-center text-white" href="{{ path("$self@show", $model) }}">
          @if ($model->character)
            <span class="d-inline-block ja-big ja-character ja-shadow">{{ $model->character }}</span>
          @else
            <img class="ja-character ja-image-shadow mt-1" src="{{ $model->image }}" height="72">
          @endif
        </a>
      </td>
      <td>{{ $model->meaning }}</td>
      <td class="text-md-right">
        @if ($model->kanjis_count > 0)
          <a href="{{ path('Acp\Kanjis@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->kanjis_count) }}
          </a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
