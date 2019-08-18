<table>
  @foreach ($entries as $entry)
    <tr>
      <td class="tw-pr-6">
        @ru
          {{ $entry['ru'] }}
        @en
          {{ $entry['en'] ?? '' }}
        @endru
      </td>
      <td>
        <span class="{{ !empty($entry['phonetic']) ? 'tooltipped tooltipped-n' : '' }}" aria-label="{{ $entry['phonetic'] ?? '' }}">
          {!! $entry['de'] !!}
        </span>
      </td>
    </tr>
  @endforeach
</table>
