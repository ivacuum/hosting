@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <div class="list-group text-center">
      @can('show', $model)
        <a class="list-group-item {{ $view === "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
          {{ trans("$tpl.show") }}
        </a>
      @endcan
      @can('edit', $model)
        <a class="list-group-item {{ $view === "$tpl.edit" ? 'active' : '' }}" href="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
          {{ trans("$tpl.edit") }}
        </a>
      @endcan
      @yield('model_menu')
      @if (is_array($show_with_count))
        @foreach ($show_with_count as $field)
          @php ($count_field = "{$field}_count")
          @if ($model->{$count_field})
            <a class="list-group-item" href="{{ action("Acp\\".studly_case($field)."@index", [$model->getForeignKey() => $model->id]) }}">
              {{ trans("acp.{$field}.index") }}
              <span class="text-muted small">{{ $model->{$count_field} }}</span>
            </a>
          @endif
        @endforeach
      @endif
      @if (method_exists($model, 'www'))
        <a class="list-group-item" href="{{ $model->www() }}">
          {{ trans('acp.www') }}
          @svg (external-link)
        </a>
      @endif
      @include('acp.tpl.delete')
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="mt-0">
      @include('acp.tpl.back')
      @section('model_title')
        {{ $model->breadcrumb() }}
      @show
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
