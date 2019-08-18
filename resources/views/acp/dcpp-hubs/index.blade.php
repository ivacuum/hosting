@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'title') }}</th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'address') }}</th>
    <th class="text-md-right tw-whitespace-no-wrap">{{ ViewHelper::modelFieldTrans($model_tpl, 'clicks') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>{{ $model->externalLink() }}</td>
      <td class="text-md-right tw-whitespace-no-wrap">{{ ViewHelper::number($model->clicks) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
