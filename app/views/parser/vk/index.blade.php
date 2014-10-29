@extends('base', [
  'meta_title' => "Топ 10 vk.com/{$page} за ".$date->formatLocalized('%d %B'),
])

@section('content')
<ul class="nav nav-tabs">
  <li class="{{ Request::segment(3) == 'palnom6' || !Request::segment(3) ? 'active' : '' }}">
    <a href="{{ action("$self@index", 'palnom6') }}">Палата #6</a>
  </li>
  <li class="{{ Request::segment(3) == 'overhear' ? 'active' : '' }}">
    <a href="{{ action("$self@index", 'overhear') }}">Подслушано</a>
  </li>
  <li class="{{ Request::segment(3) == 'leprum' ? 'active' : '' }}">
    <a href="{{ action("$self@index", 'leprum') }}">Лепра</a>
  </li>
  <li class="{{ Request::segment(3) == 'pikabu' ? 'active' : '' }}">
    <a href="{{ action("$self@index", 'pikabu') }}">Пикабу</a>
  </li>
  <li class="{{ Request::segment(3) == 'factura' ? 'active' : '' }}">
    <a href="{{ action("$self@index", 'factura') }}">Фактура</a>
  </li>
</ul>

<ul class="pager">
  <li class="previous">
    <a href="{{ action("$self@index", ['page' => $page, 'date' => $previous->toDateString()]) }}">
      <span class="glyphicon glyphicon-arrow-left"></span>
      &nbsp;{{ $previous->formatLocalized('%d %B') }}
    </a>
  </li>
  <li class="next">
    <a href="{{ action("$self@index", ['page' => $page, 'date' => $next->toDateString()]) }}">
      {{ $next->formatLocalized('%d %B') }}
      <span class="glyphicon glyphicon-arrow-right"></span>
    </a>
  </li>
</ul>

@if (!sizeof($posts))
  <div class="alert alert-warning">
    Нет записей за {{ $date->formatLocalized('%d %B %Y') }}.
  </div>
@endif

@foreach ($posts as $i => $post)
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">#{{ $i + 1 }}</h3>
    </div>
    <div class="panel-body">
      <div>{{ wordwrap($post['text'], 80) }}</div>
      @if ($post['attachments'])
        @foreach ($post['attachments'] as $attach)
          @if ($attach->type == 'photo')
            <img src="{{ $attach->photo->src_big }}" alt="">
          @elseif ($attach->type == 'doc' and $attach->doc->ext == 'gif')
            <img src="{{ $attach->doc->url }}" alt="">
          @endif
        @endforeach
      @endif
    </div>
    <div class="panel-footer">
      <samp>
        <span class="glyphicon glyphicon-bullhorn"></span>
        <span class="text-muted">{{ $post['reposts'] }}</span>
        <span class="glyphicon glyphicon-heart"></span>
        <span class="text-muted">{{ $post['likes'] }}</span>
        <span class="glyphicon glyphicon-link"></span>
        <a href="{{ $post['url'] }}">permalink</a>
      </samp>
    </div>
  </div>
@endforeach

<ul class="pager">
  <li class="previous">
    <a href="{{ action("$self@index", ['page' => $page, 'date' => $previous->toDateString()]) }}">
      <span class="glyphicon glyphicon-arrow-left"></span>
      &nbsp;{{ $previous->formatLocalized('%d %B') }}
    </a>
  </li>
  <li class="next">
    <a href="{{ action("$self@index", ['page' => $page, 'date' => $next->toDateString()]) }}">
      {{ $next->formatLocalized('%d %B') }}
      <span class="glyphicon glyphicon-arrow-right"></span>
    </a>
  </li>
</ul>
@stop