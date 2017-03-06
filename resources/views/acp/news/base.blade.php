@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <div class="list-group text-center">
      <a class="list-group-item {{ $view == "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
        {{ trans("$tpl.show") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.edit" ? 'active' : '' }}" href="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
        {{ trans("$tpl.edit") }}
      </a>
      @if ($model->comments_count > 0)
        <a class="list-group-item" href="{{ action('Acp\Comments@index', ['rel_id' => $model->id, 'rel' => 'News']) }}">
          {{ trans("$tpl.comments") }}
          <span class="text-muted small">{{ $model->comments_count }}</span>
        </a>
      @endif
      <a class="list-group-item" href="{{ action('News@show', $model) }}">
        {{ trans("$tpl.www") }}
        @svg (external-link)
      </a>
      @include('acp.tpl.delete')
    </div>
    <form class="text-center mb-3" action="{{ action("$self@notify", $model) }}" method="post">
      <button class="btn btn-default" type="submit">{{ trans("$tpl.notify") }}</button>
      {{ csrf_field() }}
    </form>
  </div>
  <div class="col-sm-9">
    <h2 class="mt-0">
      @include('acp.tpl.back')
      {{ $model->title }}
      <small>{{ $model->created_at->formatLocalized('%e %B %Y') }}</small>
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
