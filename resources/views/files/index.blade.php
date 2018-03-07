@extends('base')

@section('content')
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="text-md-right">{{ ViewHelper::modelFieldTrans('file', 'id') }}</th>
      <th>{{ ViewHelper::modelFieldTrans('file', 'title') }}</th>
      <th class="text-md-right">{{ ViewHelper::modelFieldTrans('file', 'size') }}</th>
      <th class="text-md-right">{{ ViewHelper::modelFieldTrans('file', 'downloads') }}</th>
      <th>{{ ViewHelper::modelFieldTrans('file', 'created_at') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($models as $model)
      <tr>
        <td class="text-md-right">{{ $model->id }}</td>
        <td>
          <a href="{{ path("$self@download", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td class="text-md-right text-muted text-nowrap">{{ ViewHelper::size($model->size) }}</td>
        <td class="text-md-right text-nowrap">{{ ViewHelper::number($model->downloads) }}</td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

@include('tpl.paginator', ['paginator' => $models])
@endsection
