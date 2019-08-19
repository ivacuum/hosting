@extends('base')

@section('content')
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="md:tw-text-right">{{ ViewHelper::modelFieldTrans('file', 'id') }}</th>
      <th>{{ ViewHelper::modelFieldTrans('file', 'title') }}</th>
      <th class="md:tw-text-right">{{ ViewHelper::modelFieldTrans('file', 'size') }}</th>
      <th class="md:tw-text-right">{{ ViewHelper::modelFieldTrans('file', 'downloads') }}</th>
      <th>{{ ViewHelper::modelFieldTrans('file', 'created_at') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($models as $model)
      <tr>
        <td class="md:tw-text-right">{{ $model->id }}</td>
        <td>
          <a href="{{ path("$self@download", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td class="md:tw-text-right text-muted tw-whitespace-no-wrap">{{ ViewHelper::size($model->size) }}</td>
        <td class="md:tw-text-right tw-whitespace-no-wrap">{{ ViewHelper::number($model->downloads) }}</td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

@include('tpl.paginator', ['paginator' => $models])
@endsection
