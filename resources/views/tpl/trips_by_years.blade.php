<?php
/** @var \Illuminate\Database\Eloquent\Collection|\App\Domain\Life\Models\Trip[]|\App\Domain\Life\Models\Gig[] $models */
?>

@foreach ($modelsByYears as $year => $models)
  <div class="flex gap-3 {{ !$loop->first ? 'mt-6' : '' }}">
    <div>
      <div class="sticky top-2 font-bold">{{ $year }}</div>
    </div>
    <div class="w-full">
      @foreach ($models as $model)
        <div class="{{ !$loop->last ? 'mb-2' : '' }}">
          @if ($model instanceof \App\Domain\Life\Models\Trip)
            @if ($model->status->isPublished())
              <a class="link mr-1" href="{{ $model->www() }}">{{ $model->title }}</a>
            @else
              <span class="mr-1">{{ $model->title }}</span>
            @endif
            <span class="text-xs text-gray-500 mr-2 whitespace-nowrap">{{ $model->localizedDateWithoutYear() }}</span>
            @if ($model->status->isPublished() && $model->photos_count)
              <span class="text-xs text-gray-500 whitespace-nowrap">
                @svg (picture-o)
                {{ $model->photos_count }}
              </span>
            @endif
          @elseif ($model instanceof \App\Domain\Life\Models\Gig)
            @if ($model->status->isPublished())
              <a class="link mr-1" href="{{ $model->www() }}">{{ $model->artist->title }}</a>
            @else
              <span class="mr-1">{{ $model->artist->title }}</span>
            @endif
            <span class="text-xs text-gray-500">{{ $model->shortDate() }}</span>
          @endif
        </div>
      @endforeach
    </div>
  </div>
@endforeach
