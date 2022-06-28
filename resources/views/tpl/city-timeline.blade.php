<?php /** @var \App\Trip $row */ ?>

@if (isset($timeline) && count($timeline->flatten()) > 1)
  <div class="overflow-hidden mb-4">
    <div class="whitespace-nowrap pb-8 -mb-8 overflow-x-auto">
      <div class="text-sm flex">
        @foreach ($timeline as $year => $rows)
          <div class="flex flex-col mr-5 {{ $loop->last ? 'mr-0' : '' }}">
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
