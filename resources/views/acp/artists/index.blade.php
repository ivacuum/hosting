@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th class="text-right">#</th>
        <th>Название</th>
        <th>URL</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <td class="text-right">{{ $loop->iteration }}</td>
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
    </tbody>
  </table>
@endif
@endsection
