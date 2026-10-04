<?php /** @var \App\Domain\Life\Models\Trip $row */ ?>

@if (isset($timeline) && count($timeline->flatten()) > 1)
  <div class="overflow-hidden mb-4">
    <div class="js-timeline whitespace-nowrap pb-8 -mb-8 overflow-x-auto snap-x snap-mandatory">
      <div class="text-sm flex gap-5">
        @foreach ($timeline as $year => $rows)
          <div class="flex flex-col snap-start">
            <div class="font-bold">{{ $year }}</div>
            @foreach ($rows as $row)
              <div class="text-xs">
                @if ($row->id === $trip->id)
                  <mark>{{ $row->timelinePeriod() }}</mark>
                @elseif ($row->status->isPublished())
                  <a class="link" href="{{ $row->www() }}">{{ $row->timelinePeriod() }}</a>
                @else
                  {{ $row->timelinePeriod() }}
                @endif
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
