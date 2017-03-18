@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  @if ($models instanceof Illuminate\Support\Collection)
    <small>{{ ViewHelper::number(sizeof($models)) }}</small>
  @else
    <small>{{ ViewHelper::number($models->total()) }}</small>
  @endif
  @can('create', $model)
    @include('acp.tpl.create')
  @endcan
</h3>
@yield('toolbar')
@if (!empty($filters = Request::except('filter', 'page', '_pjax')))
  <div class="my-3">
    <a class="btn btn-default" href="{{ action("$self@index") }}">
      {{ trans('acp.reset_filters') }}
      <span class="text-danger">
        @svg (times)
      </span>
    </a>
    @foreach ($filters as $key => $value)
      <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(array_merge($filters, ['page' => null, $key => null])) }}">
        {{ $key }}: {{ $value }}
        <span class="text-danger">
          @svg (times)
        </span>
      </a>
    @endforeach
  </div>
@endif
@if (sizeof($models))
  @yield('content-list')
@else
  @yield('content-list-empty')
@endif
@if ($models instanceof Illuminate\Contracts\Pagination\Paginator)
  @include('tpl.paginator', ['paginator' => $models])
@endif
@endsection
