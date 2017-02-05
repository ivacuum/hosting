@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats">
    <thead>
      <tr>
        <th>#</th>
        <th>Аккаунт</th>
        <th class="text-right">Доменов</th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $loop->iteration }}</td>
        <td>
          <a href="{{ action("$self@show", $model) }}" class="link">
            {{ $model->account }}
          </a>
        </td>
        <td class="text-right">{{ sizeof($model->domains) }}</td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
