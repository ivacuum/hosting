@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
    <th></th>
    <th class="md:text-right">
      @include('acp.tpl.sortable-header', ['key' => 'size'])
    </th>
    <th class="md:text-right">
      @include('acp.tpl.sortable-header', ['key' => 'downloads'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path([$controller, 'show'], $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status === App\File::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Файл скрыт">
            @svg (eye-slash)
          </span>
        @endif
      </td>
      <td class="md:text-right text-muted whitespace-nowrap">{{ ViewHelper::size($model->size) }}</td>
      <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($model->downloads) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
