@extends('base')

@section('content')
@if (sizeof($news))
  <div class="row">
    <div class="col-md-8">
      @foreach ($news as $model)
        <h3 class="mt-0"><a class="link" href="{{ action("$self@show", $model) }}">{{ $model->title }}</a></h3>
        <div class="text-muted f14 mb-3">
          <span class="text-nowrap mr-3">
            <span class="mr-1 svg-muted">
              @svg (calendar-o)
            </span>
            {{ $model->created_at->formatLocalized('%e %B %Y') }}
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
              {{ ViewHelper::number($model->comments_count) }}
            </span>
          @endif
        </div>
        <div class="mb-5">
          <div class="hidden-xs">{!! $model->html !!}</div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="text-center">
    @include('tpl.paginator', ['paginator' => $news])
  </div>
@else
  <p>По данным критериям новости не найдены.</p>
@endif

@endsection
