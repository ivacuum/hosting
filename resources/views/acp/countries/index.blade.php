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
        <th></th>
        <th>Страна</th>
        <th>URL</th>
        <th class="text-right">@svg (eye)</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <td>{{ $model->emoji }}</td>
          <td>
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->title }}
            </a>
          </td>
          <td>
            <a class="link" href="{{ $locale_uri }}/life/countries/{{ $model->slug }}">
              {{ $model->slug }}
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
@endif
@endsection
