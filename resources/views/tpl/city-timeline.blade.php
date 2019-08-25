@if (isset($timeline) && sizeof($timeline->flatten()) > 1)
  <div class="tw-overflow-hidden tw-mb-4">
    <div class="tw-whitespace-no-wrap tw-pb-8 tw--mb-8 tw-overflow-x-auto">
      <div class="tw-text-sm tw-flex">
        @foreach ($timeline as $year => $rows)
          <div class="tw-flex tw-flex-col tw-mr-5 {{ $loop->last ? 'tw-mr-0' : '' }}">
            <div class="tw-font-bold">{{ $year }}</div>
            @foreach ($rows as $row)
              <div class="tw-text-xs">
                @if ($row->id === $trip->id)
                  <mark>{{ $row->timelinePeriod() }}</mark>
                @elseif ($row->status === App\Trip::STATUS_PUBLISHED)
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
