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
        <th>Электронная почта</th>
        <th>Активен</th>
        <th>Дата реги</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <td class="text-right">{{ $model->id }}</td>
          <td>
            <a href="{{ action("$self@show", $model) }}" class="link">
              {{ $model->email }}
            </a>
          </td>
          <td>
            @if ($model->status === App\User::STATUS_ACTIVE)
              Да
            @endif
          </td>
          <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @include('tpl.paginator', ['class' => 'mt-3 text-center', 'paginator' => $models])
@endif
@endsection
