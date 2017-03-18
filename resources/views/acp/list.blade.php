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
@if (sizeof($models))
  @yield('content-list')
@else
  @yield('content-list-empty')
@endif
@if ($models instanceof Illuminate\Contracts\Pagination\Paginator)
  @include('tpl.paginator', ['paginator' => $models])
@endif
@endsection
