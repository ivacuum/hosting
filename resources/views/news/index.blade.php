@extends('base')

@section('content')
@if (sizeof($news))
  <div class="row">
    <div class="col-md-8">
      @foreach ($news as $model)
        <article itemscope itemtype="http://schema.org/BlogPosting">
          <header>
            <h3 class="mt-0" itemprop="headline"><a class="link" href="{{ action("$self@show", $model) }}" itemprop="url">{{ $model->title }}</a></h3>
            <div class="text-muted f14 mb-3">
              <span class="text-nowrap mr-3">
                <span class="mr-1 svg-muted">
                  @svg (calendar-o)
                </span>
                <time itemprop="datePublished" datetime="{{ $model->created_at->toDateString() }}">
                  {{ $model->created_at->formatLocalized('%e %B %Y') }}
                </time>
              </span>
              @if (!is_null($model->user) && $model->user->login)
                <span class="text-nowrap mr-3">
                  <span class="mr-1 svg-muted">
                    @svg (pencil)
                  </span>
                  {{ $model->user->login }}
                </span>
              @endif
              <span class="text-nowrap mr-3">
                <span class="mr-1 svg-muted">
                  @svg (eye)
                </span>
                {{ ViewHelper::number($model->views) }}
              </span>
              @if ($model->comments_count)
                <span class="text-nowrap mr-3">
                  <span class="mr-1 svg-muted">
                    @svg (comment-o)
                  </span>
                  <span itemprop="commentCount">{{ ViewHelper::number($model->comments_count) }}</span>
                </span>
              @endif
            </div>
          </header>
          <div class="mb-5">
            <div class="hidden-xs" itemprop="articleBody">{!! $model->html !!}</div>
          </div>
        </article>
      @endforeach
    </div>
  </div>

  @include('tpl.paginator', ['class' => 'mt-3 text-center', 'paginator' => $news])
@else
  @ru
    <p>По данным критериям новости не найдены.</p>
  @en
    <p>No news found.</p>
  @endlang
@endif

@endsection
