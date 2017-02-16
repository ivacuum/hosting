@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell"></div>
      <div class="flex-cell">Страна</div>
      <div class="flex-cell">URL</div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell">{{ $model->emoji }}</div>
          <div class="flex-cell">
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->title }}
            </a>
          </div>
          <div class="flex-cell">
            <a class="link" href="{{ $locale_uri }}/life/countries/{{ $model->slug }}">
              {{ $model->slug }}
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
@endsection
