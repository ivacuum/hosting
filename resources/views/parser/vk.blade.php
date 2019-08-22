<?php
/** @var string $vkpage */
/** @var Carbon\Carbon $date */
?>

@extends('base', [
  'meta_title' => "Топ 10 vk.com/{$vkpage} за " . $date->formatLocalized('%e %B'),
])

@section('content')
<div class="nav-link-tabs-fader nav-border tw--mt-4">
  <div class="nav-scroll-container">
    <div class="nav-scroll">
      <nav class="nav nav-link-tabs">
        <a class="nav-link js-pjax {{ $vkpage == 'pn6' ? 'active' : '' }}" href="{{ path('ParserVk@index', ['page' => 'pn6']) }}">#6</a>
        <a class="nav-link js-pjax {{ $vkpage == 'overhear' ? 'active' : '' }}" href="{{ path('ParserVk@index', ['page' => 'overhear']) }}">Подслушано</a>
        <a class="nav-link js-pjax {{ $vkpage == 'pikabu' ? 'active' : '' }}" href="{{ path('ParserVk@index', ['page' => 'pikabu']) }}">Пикабу</a>
      </nav>
    </div>
  </div>
</div>

<form class="tw-flex tw-justify-between tw-my-4" action="{{ path('ParserVk@indexPost') }}" method="post">
  @csrf
  <div>
    @if (!empty($next))
      <a class="btn border-b125 js-pjax" href="{{ path('ParserVk@index', ['page' => $vkpage, 'date' => $next->toDateString(), 'own' => $own, 'token' => $token]) }}" id="prev_page">
        @svg (chevron-left)
        {{ $next->formatLocalized('%e %B') }}
      </a>
    @endif
  </div>
  <div class="tw-hidden sm:tw-flex tw-items-center">
    <span class="tw-hidden md:tw-block">Топ 10</span>
    <input class="form-control tw-mx-2" name="slug" value="{{ $vkpage }}" style="width: 8em;" autocapitalize="none">
    за {{ $date->formatLocalized('%e %B') }}
    @if ($date->year !== now()->year)
      {{ $date->year }}
    @endif
  </div>
  <div>
    @if (!empty($previous))
      <a class="btn border-b125 js-pjax" href="{{ path('ParserVk@index', ['page' => $vkpage, 'date' => $previous->toDateString(), 'own' => $own, 'token' => $token]) }}" id="next_page">
        {{ $previous->formatLocalized('%e %B') }}
        @svg (chevron-right)
      </a>
    @endif
  </div>
</form>

@if (!sizeof($posts))
  <div class="alert alert-warning">
    Нет записей за {{ $date->formatLocalized('%e %B %Y') }}.
  </div>
@endif

<div>
<?php
/** @var array[] $posts */
?>
@foreach ($posts as $post)
  <div class="card tw-border-l-0 sm:tw-border-l tw-border-r-0 sm:tw-border-r tw-rounded-none sm:tw-rounded tw-mb-4 tw--mx-4 sm:tw-mx-0 js-shortcuts-item">
    <div class="card-body tw-pb-0 tw-break-words">
      @if ($post['text'])
        <div class="life-text tw-mb-0 tw-whitespace-pre-line">{{ $post['text'] }}</div>
      @endif
      @if (!empty($post['copy_history']))
        <div class="life-text {{ $post['text'] ? 'tw-mt-4' : '' }} tw-mb-0"><strong>Репост</strong></div>
        <div class="life-text tw-mb-0 tw-whitespace-pre-line">{{ $post['copy_history'][0]->text }}</div>
      @endif
      @if ($post['attachments'])
        <div class="tw-mt-2">
        @if ($post['photos'] > 1)
          <div class="pic-container">
        @elseif ($post['photos'] == 1)
          <div class="img-container {{ sizeof($post['attachments']) <= 1 ? 'tw-mb-0' : '' }}">
        @endif
        @foreach ($post['attachments'] as $attach)
          @if ($attach->type == 'photo' && isset($attach->photo->photo_604))
            <img class="tw-block markdown-responsive-image tw-mx-auto {{ !$loop->first ? 'js-shortcuts-item' : '' }}" src="{{ @$attach->photo->photo_1280 ?: @$attach->photo->photo_807 ?: $attach->photo->photo_604 }}">
          @endif
        @endforeach
        @if ($post['photos'] > 0)
          </div>
        @endif

        @foreach ($post['attachments'] as $attach)
          @if ($attach->type == 'doc' && $attach->doc->ext == 'gif' && isset($attach->doc->preview->video))
            <p>
              <div>
                @svg (paperclip)
                {{ $attach->doc->title }}
              </div>
              <div class="embed-responsive embed-responsive-4by3">
                <video
                  controls
                  class="embed-responsive-item"
                  width="{{ $attach->doc->preview->video->width }}"
                  height="{{ $attach->doc->preview->video->height }}"
                  poster="{{ Illuminate\Support\Arr::last($attach->doc->preview->photo->sizes)->src }}"
                >
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
              <span class="tw-text-sm tw-text-gray-600">
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
            <div>
              <a class="link" href="{{ $attach->link->url }}">
                @svg (link)
                {{ $attach->link->title }}
              </a>
              <div class="tw-text-sm tw-text-gray-600">
                {{ $attach->link->url }}
              </div>
            </div>
          @endif
        @endforeach
        </div>
      @endif
      <div class="tw-mt-2 tw-mb-1 tw-text-gray-600">
        <samp class="tw-text-xs svg-labels tw-justify-end">
          <a class="svg-flex svg-label" href="{{ $post['url'] }}">
            @svg (link)
          </a>
          <span class="svg-flex svg-label">
            <a class="js-share-click" href="{{ $post['url'] }}">
              @svg (bullhorn)
            </a>
            {{ ViewHelper::numberShort($post['reposts']) }}
          </span>
          <span class="svg-flex svg-label">
            @svg (heart)
            {{ ViewHelper::numberShort($post['likes']) }}
          </span>
          <span class="svg-flex svg-label">
            @svg (eye)
            {{ ViewHelper::numberShort($post['views']) }}
          </span>
        </samp>
      </div>
    </div>
  </div>
@endforeach
</div>

<div class="tw-flex tw-justify-between">
  @if (!empty($next))
    <div>
      <a class="btn border-b125 js-pjax" href="{{ path('ParserVk@index', ['page' => $vkpage, 'date' => $next->toDateString(), 'own' => $own, 'token' => $token]) }}">
        @svg (chevron-left)
        {{ $next->formatLocalized('%e %B') }}
      </a>
    </div>
  @endif
  @if (!empty($previous))
    <div>
      <a class="btn border-b125 js-pjax" href="{{ path('ParserVk@index', ['page' => $vkpage, 'date' => $previous->toDateString(), 'own' => $own, 'token' => $token]) }}">
        {{ $previous->formatLocalized('%e %B') }}
        @svg (chevron-right)
      </a>
    </div>
  @endif
</div>
@endsection
