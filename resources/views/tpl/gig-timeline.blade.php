<?php
/** @var \App\Gig $row */
?>

@if (count($timeline) > 1)
  <div class="overflow-hidden mb-4">
    <div class="whitespace-nowrap pb-8 -mb-8 overflow-x-auto">
      <div class="text-sm flex">
        @foreach ($timeline as $year => $rows)
          <div class="flex flex-col mr-5 {{ $loop->last ? 'mr-0' : '' }}">
            <div class="font-bold">{{ $year }}</div>
            @foreach ($rows as $row)
              <div class="text-xs">
                @if ($row->id === $gig->id)
                  <mark>{{ $row->shortDate() }}</mark>
                @elseif ($row->status->isPublished())
                  <a class="link" href="{{ $row->www() }}">{{ $row->shortDate() }}</a>
                @else
                  {{ $row->shortDate() }}
                @endif
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
