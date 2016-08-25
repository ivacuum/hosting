@extends('acp.base')

@section('content')
<h3>
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <th>#</th>
        <th>Электронная почта</th>
        <th>Активен</th>
        <th>Админ</th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $model->id }}</td>
        <td>
          <a href="{{ action("$self@show", $model) }}" class="link">
            {{ $model->email }}
          </a>
        </td>
        <td>
          @if ($model->active)
            Да
          @endif
        <td>
          @if ($model->is_admin)
            Да
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
