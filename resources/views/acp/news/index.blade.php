@extends('acp.base')

@section('content')
<h3>
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats">
    <thead>
      <tr>
        <th>ID</th>
        <th>Название</th>
        <th>@svg (eye)</th>
        <th>Дата</th>
      </tr>
    </thead>
    @foreach ($models as $i => $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $model->id }}</td>
        <td>
          <a class="link" href="{{ action("$self@show", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td>{{ ViewHelper::number($model->views) }}</td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
  </table>

  <div class="mt-3 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
