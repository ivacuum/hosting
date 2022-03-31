<?php
/** @var \Illuminate\Database\Eloquent\Collection|App\Trip[]|\App\Gig[] $models */
?>

@foreach ($modelsByYears as $year => $models)
  <div class="flex {{ !$loop->first ? 'mt-6' : '' }}">
    <div>
      <div class="sticky top-2 font-bold mr-3">{{ $year }}</div>
    </div>
    <div class="w-full">
      @foreach ($models as $model)
        <div class="{{ !$loop->last ? 'mb-2' : '' }}">
          @if ($model instanceof App\Trip)
            @if ($model->status->isPublished())
              <a class="link mr-1" href="{{ $model->www() }}">{{ $model->title }}</a>
            @else
              <span class="mr-1">{{ $model->title }}</span>
            @endif
            <span class="text-xs text-muted mr-2 whitespace-nowrap">{{ $model->localizedDateWithoutYear() }}</span>
            @if ($model->status->isPublished() && $model->photos_count)
              <span class="text-xs text-muted whitespace-nowrap">
                @svg (picture-o)
                {{ $model->photos_count }}
              </span>
            @endif
          @elseif ($model instanceof App\Gig)
            @if ($model->status->isPublished())
              <a class="link mr-1" href="{{ $model->www() }}">{{ $model->artist->title }}</a>
            @else
              <span class="mr-1">{{ $model->artist->title }}</span>
            @endif
            <span class="text-xs text-muted">{{ $model->shortDate() }}</span>
          @endif
        </div>
      @endforeach
    </div>
  </div>
@endforeach
