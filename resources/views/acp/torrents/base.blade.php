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
      <a class="list-group-item" href="{{ action('Acp\Users@show', $model->user_id) }}">
        {{ trans("$tpl.user") }}
      </a>
      @if ($model->comments_count > 0)
        <a class="list-group-item" href="{{ action('Acp\Comments@index', ['rel_id' => $model->id, 'rel' => 'Torrent']) }}">
          {{ trans("$tpl.comments") }}
          <span class="text-muted small">{{ $model->comments_count }}</span>
        </a>
      @endif
      <a class="list-group-item" href="{{ action("$self@updateRto", $model) }}">
        {{ trans("$tpl.update_rto") }}
      </a>
      <a class="list-group-item" href="{{ action('Torrents@torrent', $model) }}">
        {{ trans("$tpl.www") }}
        @svg (external-link)
      </a>
      @include('acp.tpl.delete')
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="mt-0">
      @include('acp.tpl.back')
      {{ $model->title }}
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
