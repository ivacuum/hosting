@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell">#</div>
      <div class="flex-cell">Название</div>
      <div class="flex-cell"></div>
      <div class="flex-cell">Дата</div>
      <div class="flex-cell">URL</div>
      <div class="flex-cell text-right">@svg (eye)</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell">{{ $loop->iteration }}</div>
          <div class="flex-cell">
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->title }}
            </a>
          </div>
          <div class="flex-cell">
            @if ($model->status === App\Trip::STATUS_HIDDEN)
              <span class="tooltipped tooltipped-n" aria-label="Заметка скрыта">
                @svg (eye-slash)
              </span>
            @elseif ($model->status === App\Trip::STATUS_INACTIVE)
              <span class="tooltipped tooltipped-n" aria-label="Заметка неактивна">
                @svg (pencil)
              </span>
            @endif
          </div>
          <div class="flex-cell">{{ $model->localizedDate() }}</div>
          <div class="flex-cell">
            <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
              {{ $model->slug }}
            </a>
          </div>
          <div class="flex-cell text-right">
            @if ($model->views > 0)
              {{ ViewHelper::number($model->views) }}
            @endif
          </div>
          <div class="flex-cell">
            @if ($model->meta_image)
              <span class="tooltipped tooltipped-n" aria-label="Задано фото">
                @svg (paperclip)
              </span>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
@endsection
