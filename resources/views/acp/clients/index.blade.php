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
        <th>Клиент</th>
        <th>Почта</th>
        <th>Комментарии</th>
      </tr>
    </thead>
    @foreach ($models as $i => $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a href="{{ action("$self@show", $model) }}" class="link">
            {{ $model->name }}
          </a>
        </td>
        <td>{{ $model->email }}</td>
        <td>{!! nl2br(str_limit($model->text, 100)) !!}</td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
