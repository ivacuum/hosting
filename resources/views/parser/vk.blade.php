@extends('base', [
  'meta_title' => "Топ 10 vk.com/{$vkpage} за " . $date->formatLocalized('%e %B'),
])

@section('content')
<ul class="nav nav-link-tabs">
  <li class="{{ $vkpage == 'pn6' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/pn6">#6</a>
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
  <li class="{{ $vkpage == 'decaying_europe' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/decaying_europe">Запад</a>
  </li>
  <li class="{{ $vkpage == 'vandroukiru' ? 'active' : '' }}">
    <a class="js-pjax" href="/parser/vk/vandroukiru">
      @svg (plane)
    </a>
  </li>
</ul>

<form action="{{ action('ParserVk@indexPost') }}" method="post">
  <ul class="pager">
    @if (!empty($next))
      <li class="previous">
        <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $next->toDateString() }}?own={{ $own }}" id="previous_page">
          @svg (chevron-left)
          {{ $next->formatLocalized('%e %B') }}
        </a>
      </li>
    @endif
    <li class="hidden-xs">
      Топ 10
      <input class="form-control d-inline-block" type="text" name="slug" value="{{ $vkpage }}" style="width: 8em;">
      за {{ $date->formatLocalized('%e %B') }}
      @if ($date->year !== Carbon\Carbon::now()->year)
        {{ $date->year }}
      @endif
    </li>
    @if (!empty($previous))
      <li class="next">
        <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $previous->toDateString() }}?own={{ $own }}" id="next_page">
          &nbsp;{{ $previous->formatLocalized('%e %B') }}
          @svg (chevron-right)
        </a>
      </li>
    @endif
  </ul>
  {{ csrf_field() }}
</form>

@if (!sizeof($posts))
  <div class="alert alert-warning">
    Нет записей за {{ $date->formatLocalized('%e %B %Y') }}.
  </div>
@endif

<div class="js-shortcuts-items">
@foreach ($posts as $i => $post)
  <div class="panel panel-default shortcuts-item">
    <div class="panel-body vk-post-container">
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
                @svg (paperclip)
                {{ $attach->doc->title }}
              </div>
              <a href="{{ $attach->doc->url }}" class="js-gif-click">
                <img src="{{ $attach->doc->thumb }}">
              </a>
            </p>
          @elseif ($attach->type == 'audio' and $attach->audio->url)
            <p>
              <a href="{{ $attach->audio->url }}" class="link">
                @svg (music)
                {{ $attach->audio->artist }} — {{ $attach->audio->title }}
              </a>
              <span class="text-muted">
                {{ sprintf('%02d', $attach->audio->duration / 60) }}:{{ sprintf('%02d', $attach->audio->duration % 60) }}
              </span>
            </p>
          @elseif ($attach->type == 'video')
            <p>
              <a href="https://vk.com/video{{ $attach->video->owner_id }}_{{ $attach->video->vid }}" class="link">
                @svg (film)
                {{ $attach->video->title }}
              </a>
              <span class="text-muted">
                {{ sprintf('%02d', $attach->video->duration / 60) }}:{{ sprintf('%02d', $attach->video->duration % 60) }}
              </span>
            </p>
          @elseif ($attach->type == 'page')
            <p>
              <a href="{{ $attach->page->view_url }}" class="link">
                @svg (file-text-o)
                {{ $attach->page->title }}
              </a>
            </p>
          @elseif ($attach->type == 'link')
            @if (isset($attach->link->image_big))
              <div class="img-container">
                <img src="{{ @$attach->link->image_big }}">
              </div>
            @endif
            <p>
              <a href="{{ $attach->link->url }}" class="link">
                @svg (link)
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
          @svg (bullhorn)
          <span class="text-muted">{{ $post['reposts'] }}</span>
          @svg (heart)
          <span class="text-muted">{{ $post['likes'] }}</span>
          <a href="{{ $post['url'] }}">
            @svg (link)
          </a>
        </small></samp>
      </div>
    </div>
  </div>
@endforeach
</div>

<ul class="pager">
  @if (!empty($next))
    <li class="previous">
      <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $next->toDateString() }}">
        @svg (chevron-left)
        {{ $next->formatLocalized('%e %B') }}
      </a>
    </li>
  @endif
  @if (!empty($previous))
    <li class="next">
      <a class="js-pjax" href="/parser/vk/{{ $vkpage }}/{{ $previous->toDateString() }}">
        &nbsp;{{ $previous->formatLocalized('%e %B') }}
        @svg (chevron-right)
      </a>
    </li>
  @endif
</ul>
@endsection
