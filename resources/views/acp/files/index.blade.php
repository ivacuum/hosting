@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:tw-text-right">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'title') }}</th>
    <th></th>
    <th class="md:tw-text-right">
      @include('acp.tpl.sortable-header', ['key' => 'size'])
    </th>
    <th class="md:tw-text-right">
      @include('acp.tpl.sortable-header', ['key' => 'downloads'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="md:tw-text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
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
      <td class="md:tw-text-right text-muted tw-whitespace-no-wrap">{{ ViewHelper::size($model->size) }}</td>
      <td class="md:tw-text-right tw-whitespace-no-wrap">{{ ViewHelper::number($model->downloads) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
