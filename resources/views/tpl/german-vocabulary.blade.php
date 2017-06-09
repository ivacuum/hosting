<table>
  @foreach ($entries as $entry)
    <tr>
      <td class="pr-4">
        @ru
          {{ $entry['ru'] }}
        @en
          {{ $entry['en'] ?? '' }}
        @endlang
      </td>
      <td>
        <span class="{{ !empty($entry['phonetic']) ? 'tooltipped tooltipped-n' : '' }}" aria-label="{{ $entry['phonetic'] ?? '' }}">
          {!! $entry['de'] !!}
        </span>
      </td>
    </tr>
  @endforeach
</table>
