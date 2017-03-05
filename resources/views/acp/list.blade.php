@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  @if ($models instanceof Illuminate\Support\Collection)
    <small>{{ sizeof($models) }}</small>
  @else
    <small>{{ $models->total() }}</small>
  @endif
  @if (method_exists("App\\Http\\Controllers\\{$self}", 'create'))
    @include('acp.tpl.create')
  @endif
</h3>
@if (sizeof($models))
  @yield('content-list')
@else
  @yield('content-list-empty')
@endif
@if ($models instanceof Illuminate\Contracts\Pagination\Paginator)
  @include('tpl.paginator', ['paginator' => $models])
@endif
@endsection
