@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>#</th>
    <th>Название</th>
    <th></th>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'date'])
    </th>
    <th>URL</th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $loop->iteration }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status === App\Gig::STATUS_HIDDEN)
          @svg (pencil)
        @endif
      </td>
      <td>{{ $model->fullDate() }}</td>
      <td>
        <a href="{{ $model->www() }}">
          {{ $model->slug }}
        </a>
      </td>
      <td class="text-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td>
        @if ($model->meta_image)
          @svg (paperclip)
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
