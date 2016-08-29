@extends('acp.base')

@section('content')
<h3>
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats m-b-1">
    <colgroup>
      <col width="35">
      <col width="*">
      <col width="35">
      <col width="200">
      <col width="200">
    </colgroup>
    <thead>
      <tr>
        <th>#</th>
        <th>Название</th>
        <th>URL</th>
      </tr>
    </thead>
    @foreach ($models as $i => $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a class="link" href="{{ action("$self@show", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td>
          <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
            {{ $model->slug }}
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
