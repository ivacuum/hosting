@if (sizeof($timeline) > 1)
  <div class="tw-overflow-hidden tw-mb-4">
    <div class="tw-whitespace-no-wrap tw-pb-8 tw--mb-8 tw-overflow-x-auto">
      <div class="tw-text-sm tw-flex">
        @foreach ($timeline as $year => $rows)
          <div class="tw-flex tw-flex-col tw-mr-5 {{ $loop->last ? 'tw-mr-0' : '' }}">
            <div class="tw-font-bold">{{ $year }}</div>
            @foreach ($rows as $row)
              <div class="tw-text-xs">
                @if ($row->id === $gig->id)
                  <mark>{{ $row->shortDate() }}</mark>
                @elseif ($row->status === App\Gig::STATUS_PUBLISHED)
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
