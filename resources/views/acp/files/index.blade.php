@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th class="text-right">ID</th>
        <th>Название</th>
        <th class="text-right">Размер</th>
        <th class="text-right">&darr;</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <td class="text-right">{{ $model->id }}</td>
          <td>
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->title }}
            </a>
          </td>
          <td class="text-right text-muted">{{ ViewHelper::size($model->size) }}</td>
          <td class="text-right">{{ ViewHelper::number($model->downloads) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @include('tpl.paginator', ['class' => 'mt-3 text-center', 'paginator' => $models])
@endif
@endsection
