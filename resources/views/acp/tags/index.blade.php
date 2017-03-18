@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>Тэг</th>
    <th class="text-right">@svg (eye)</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
      <td>
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td class="text-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
