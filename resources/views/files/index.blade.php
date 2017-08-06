@extends('base')

@section('content')
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="text-right">ID</th>
      <th>{{ trans('model.file.title') }}</th>
      <th class="text-right">{{ trans('model.file.size') }}</th>
      <th class="text-right">{{ trans('model.file.downloads') }}</th>
      <th>Добавлен</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($models as $model)
      <tr>
        <td class="text-right">{{ $model->id }}</td>
        <td>
          <a href="{{ path("$self@download", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td class="text-right text-muted">{{ ViewHelper::size($model->size) }}</td>
        <td class="text-right">{{ ViewHelper::number($model->downloads) }}</td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

@include('tpl.paginator', ['paginator' => $models])
@endsection
