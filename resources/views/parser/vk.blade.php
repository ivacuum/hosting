@extends('base', [
  'meta_title' => "Топ 10 vk.com/{$vkpage} за ".$date->formatLocalized('%d %B'),
])

@section('content')
<ul class="nav nav-tabs">
  <li class="{{ $vkpage == 'palnom6' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/palnom6">Палата #6</a>
  </li>
  <li class="{{ $vkpage == 'overhear' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/overhear">Подслушано</a>
  </li>
  <li class="{{ $vkpage == 'leprum' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/leprum">Лепра</a>
  </li>
  <li class="{{ $vkpage == 'pikabu' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/pikabu">Пикабу</a>
  </li>
  <li class="{{ $vkpage == 'factura' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/factura">Фактура</a>
  </li>
  <li class="{{ $vkpage == 'decaying_europe' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/decaying_europe">Запад</a>
  </li>
</ul>

<ul class="pager">
  <li class="previous">
    <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $next->toDateString() }}" id="previous_page">
      <i class="fa fa-chevron-left"></i>
      {{ $next->formatLocalized('%e %B') }}
    </a>
  </li>
  <li class="next">
    <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $previous->toDateString() }}" id="next_page">
      &nbsp;{{ $previous->formatLocalized('%e %B') }}
      <i class="fa fa-chevron-right"></i>
    </a>
  </li>
</ul>

@if (!sizeof($posts))
  <div class="alert alert-warning">
    Нет записей за {{ $date->formatLocalized('%d %B %Y') }}.
  </div>
@endif

<div class="js-shortcuts-items">
@foreach ($posts as $i => $post)
  <div class="panel panel-default shortcuts-item">
    <div class="panel-body">
      @if ($post['text'])
        <div class="vk-post-content lead">{!! $post['text'] !!}</div>
      @endif
      @if ($post['attachments'])
        <div class="vk-post-attachments">
        @if ($post['photos'] > 1)
          <div class="fotorama fotorama-left">
        @elseif ($post['photos'] == 1)
          @if (sizeof($post['attachments']) > 1)
            <div class="img-container">
          @else
            <div class="vk-post-img-container">
          @endif
        @endif
        @foreach ($post['attachments'] as $attach)
          @if ($attach->type == 'photo')
            <img src="{{ @$attach->photo->src_xxbig ?: @$attach->photo->src_xbig ?: $attach->photo->src_big }}" width="{{ $attach->photo->width }}" height="{{ $attach->photo->height }}">
          @endif
        @endforeach
        @if ($post['photos'] > 0)
          </div>
        @endif

        @foreach ($post['attachments'] as $attach)
          @if ($attach->type == 'doc' and $attach->doc->ext == 'gif')
            <p>
              <div>
                <i class="fa fa-paperclip"></i>
                {{ $attach->doc->title }}
              </div>
              <a href="{{ $attach->doc->url }}" class="js-gif-click">
                <img src="{{ $attach->doc->thumb }}">
              </a>
            </p>
          @elseif ($attach->type == 'audio' and $attach->audio->url)
            <p>
              <a href="{{ $attach->audio->url }}" class="link"><i class="fa fa-music"></i> {{ $attach->audio->artist }} — {{ $attach->audio->title }}</a>
              <span class="text-muted">
                {{ sprintf('%02d', $attach->audio->duration / 60) }}:{{ sprintf('%02d', $attach->audio->duration % 60) }}
              </span>
            </p>
          @elseif ($attach->type == 'video')
            <p>
              <a href="https://vk.com/video{{ $attach->video->owner_id }}_{{ $attach->video->vid }}" class="link"><i class="fa fa-film"></i> {{ $attach->video->title }}</a>
              <span class="text-muted">
                {{ sprintf('%02d', $attach->video->duration / 60) }}:{{ sprintf('%02d', $attach->video->duration % 60) }}
              </span>
            </p>
          @elseif ($attach->type == 'page')
            <p>
              <a href="{{ $attach->page->view_url }}" class="link">
                <i class="fa fa-text-o"></i>
                {{ $attach->page->title }}
              </a>
            </p>
          @elseif ($attach->type == 'link')
            <p>
              <a href="{{ $attach->link->url }}" class="link">
                <i class="fa fa-link"></i>
                {{ $attach->link->title }}
              </a>
              <br>
              <span class="text-muted">
                {{ $attach->link->url }}
              </span>
            </p>
          @endif
        @endforeach
        </div>
      @endif
      <div class="vk-post-meta text-muted text-right">
        <samp><small>
          #{{ $i + 1 }}
          <i class="fa fa-bullhorn"></i>
          <span class="text-muted">{{ $post['reposts'] }}</span>
          <i class="fa fa-heart"></i>
          <span class="text-muted">{{ $post['likes'] }}</span>
          <a href="{{ $post['url'] }}" class="link"><i class="fa fa-link"></i></a>
        </small></samp>
      </div>
    </div>
  </div>
@endforeach
</div>

<ul class="pager">
  <li class="previous">
    <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $next->toDateString() }}">
      <i class="fa fa-chevron-left"></i>
      {{ $next->formatLocalized('%e %B') }}
    </a>
  </li>
  <li class="next">
    <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $previous->toDateString() }}">
      &nbsp;{{ $previous->formatLocalized('%e %B') }}
      <i class="fa fa-chevron-right"></i>
    </a>
  </li>
</ul>
@stop