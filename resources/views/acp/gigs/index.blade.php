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
            @if ($model->status === App\Gig::STATUS_HIDDEN)
              @svg (pencil)
            @endif
          </div>
          <div class="flex-cell">{{ $model->fullDate() }}</div>
          <div class="flex-cell">
            <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
              {{ $model->slug }}
            </a>
          </div>
          <div class="flex-cell">
            @if ($model->meta_image)
              @svg (paperclip)
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
@endsection
