@extends('acp.base')

@section('content')
<div class="flex items-center flex-wrap mb-2 -mt-2">
  <h3 class="font-medium text-2xl mb-1 mr-4">
    @lang("$tpl.index")
    <span class="text-base text-gray-500 whitespace-nowrap">
      {{ $models instanceof Illuminate\Support\Collection
          ? ViewHelper::number(count($models))
          : ViewHelper::number($models->total())
      }}
    </span>
  </h3>
  @yield('heading-after-title')
  @can('create', $model)
    @include('acp.tpl.create-button')
  @endcan
  @if (!empty($searchForm))
    <form class="my-1 mr-2">
      <input class="the-input" type="search" name="q" enterkeyhint="search" placeholder="{{ ViewHelper::modelFieldTrans($modelTpl, 'q_placeholder') }}" value="{{ $q ?? '' }}" autocapitalize="none">
    </form>
  @endif
  @yield('heading-after-search')
</div>

@yield('toolbar')

@if (!empty($filters = Request::except(['filter', 'page', 'sd', 'sk'])))
  <div class="my-2">
    <a class="btn btn-default my-1" href="{{ Acp::index($model) }}">
      @lang('acp.reset_filters')
    </a>
    @foreach ($filters as $key => $value)
      <a class="btn btn-default my-1" href="{{ fullUrl(array_merge($filters, ['page' => null, $key => null])) }}">
        <span class="text-gray-500">{{ $key }}:</span>
        <span class="font-medium">{{ $value }}</span>
        <span class="text-red-600">
          @svg (times)
        </span>
      </a>
    @endforeach
  </div>
@endif

@if (count($models))
  @yield('content-list')
@else
  @yield('content-list-empty')
@endif

@if ($models instanceof Illuminate\Contracts\Pagination\Paginator)
  @include('tpl.paginator', ['paginator' => $models])
@endif
@endsection
