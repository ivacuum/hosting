@extends('base', [
  'meta_title' => "Топ 10 vk.com/{$vkpage} за " . $date->formatLocalized('%e %B'),
])

@section('content')
<ul class="nav nav-link-tabs">
  <li class="{{ $vkpage == 'pn6' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => 'pn6']) }}">#6</a>
  </li>
  <li class="{{ $vkpage == 'overhear' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => 'overhear']) }}">Подслушано</a>
  </li>
  {{--
  <li class="{{ $vkpage == 'leprum' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => 'leprum']) }}">Лепра</a>
  </li>
  --}}
  <li class="{{ $vkpage == 'pikabu' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => 'pikabu']) }}">Пикабу</a>
  </li>
  <li class="{{ $vkpage == 'decaying_europe' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => 'decaying_europe']) }}">Запад</a>
  </li>
  <li class="{{ $vkpage == 'vandroukiru' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => 'vandroukiru']) }}">
      @svg (plane)
    </a>
  </li>
</ul>

<form action="{{ action('ParserVk@indexPost') }}" method="post">
  <ul class="pager">
    @if (!empty($next))
      <li class="previous">
        <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => $vkpage, 'date' => $next->toDateString(), 'own' => $own, 'token' => $token]) }}" id="previous_page">
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
        <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => $vkpage, 'date' => $previous->toDateString(), 'own' => $own, 'token' => $token]) }}" id="next_page">
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
@foreach ($posts as $post)
  <div class="panel panel-default shortcuts-item">
    <div class="panel-body vk-post-container">
      @if ($post['text'])
        <div class="vk-post-content life-text">{!! nl2br(e($post['text'])) !!}</div>
      @endif
      @if (!empty($post['copy_history']))
        <div class="life-text {{ $post['text'] ? 'mt-3' : '' }} mb-0"><strong>Репост</strong></div>
        <div class="vk-post-content life-text">{!! nl2br(e($post['copy_history'][0]->text)) !!}</div>
      @endif
      @if ($post['attachments'])
        <div class="vk-post-attachments">
        @if ($post['photos'] > 1)
          <div class="pic-container js-lazy" data-lazy-type="fotorama">
        @elseif ($post['photos'] == 1)
          <div class="img-container {{ sizeof($post['attachments']) <= 1 ? 'mb-0' : '' }}">
        @endif
        @foreach ($post['attachments'] as $attach)
          @if ($attach->type == 'photo' && isset($attach->photo->photo_604))
            <img src="{{ @$attach->photo->photo_1280 ?: @$attach->photo->photo_807 ?: $attach->photo->photo_604 }}">
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
              <div class="embed-responsive embed-responsive-4by3">
                <video class="embed-responsive-item" width="{{ $attach->doc->preview->video->width }}" height="{{ $attach->doc->preview->video->height }}" controls>
                  <source src="{{ $attach->doc->preview->video->src }}" type="video/mp4">
                </video>
              </div>
            </p>
          @elseif ($attach->type == 'audio' and $attach->audio->url)
            <p>
              <a class="link" href="{{ $attach->audio->url }}">
                @svg (music)
                {{ $attach->audio->artist }} — {{ $attach->audio->title }}
              </a>
              <span class="text-muted">
                {{ sprintf('%02d', $attach->audio->duration / 60) }}:{{ sprintf('%02d', $attach->audio->duration % 60) }}
              </span>
            </p>
          @elseif ($attach->type == 'video')
            <p>
              <a class="link" href="https://vk.com/video{{ $attach->video->owner_id }}_{{ $attach->video->id }}">
                @svg (film)
                {{ $attach->video->title }}
              </a>
              <span class="text-muted">
                {{ sprintf('%02d', $attach->video->duration / 60) }}:{{ sprintf('%02d', $attach->video->duration % 60) }}
              </span>
            </p>
          @elseif ($attach->type == 'page')
            <p>
              <a class="link" href="{{ $attach->page->view_url }}">
                @svg (file-text-o)
                {{ $attach->page->title }}
              </a>
            </p>
          @elseif ($attach->type == 'link')
            @if (isset($attach->link->photo->photo_604))
              <div class="img-container">
                <img src="{{ @$attach->link->photo->photo_604 }}">
              </div>
            @endif
            <p>
              <a class="link" href="{{ $attach->link->url }}">
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
          #{{ $loop->iteration }}
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

<ul class="pager mb-0">
  @if (!empty($next))
    <li class="previous">
      <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => $vkpage, 'date' => $next->toDateString(), 'own' => $own, 'token' => $token]) }}">
        @svg (chevron-left)
        {{ $next->formatLocalized('%e %B') }}
      </a>
    </li>
  @endif
  @if (!empty($previous))
    <li class="next">
      <a class="js-pjax" href="{{ action('ParserVk@index', ['page' => $vkpage, 'date' => $previous->toDateString(), 'own' => $own, 'token' => $token]) }}">
        &nbsp;{{ $previous->formatLocalized('%e %B') }}
        @svg (chevron-right)
      </a>
    </li>
  @endif
</ul>
@endsection
