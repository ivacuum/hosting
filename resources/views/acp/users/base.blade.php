@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <div class="list-group list-group-svg">
      <a class="list-group-item {{ $view == "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
        {{ trans("$tpl.show") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.edit" ? 'active' : '' }}" href="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
        {{ trans("$tpl.edit") }}
      </a>
      @if (($comments_count = $model->commentsCount()) > 0)
        <a class="list-group-item" href="{{ action('Acp\Comments@index', ['user_id' => $model->id]) }}">
          {{ trans("$tpl.comments") }}
          <span class="text-muted">{{ $comments_count }}</span>
        </a>
      @endif
      @if (($images_count = $model->imagesCount()) > 0)
        <a class="list-group-item" href="{{ action('Acp\Images@index', ['user_id' => $model->id]) }}">
          {{ trans("$tpl.images") }}
          <span class="text-muted">{{ $images_count }}</span>
        </a>
      @endif
      @if (($torrents_count = $model->torrentsCount()) > 0)
        <a class="list-group-item" href="{{ action('Acp\Torrents@index', ['user_id' => $model->id]) }}">
          {{ trans("$tpl.torrents") }}
          <span class="text-muted">{{ $torrents_count }}</span>
        </a>
      @endif
      @include('acp.tpl.delete', ['id' => $model])
    </div>
  </div>
  <div class="col-sm-9">
    <h2 class="mt-0">
      @include('acp.tpl.back')
      {{ $model->email }}
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
