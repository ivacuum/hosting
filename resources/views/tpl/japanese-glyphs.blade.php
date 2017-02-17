<table>
  @foreach ($glyphs as $glyph)
    <tr>
      <td class="pr-4">
        @ru
          {{ $glyph['ru'] }}
        @en
          {{ $glyph['en'] }}
        @endlang
      </td>
      <td class="f28">
        <span class="tooltipped tooltipped-n" aria-label="{{ $glyph['phonetic'] }}">{{ $glyph['jp'] }}</span>
      </td>
    </tr>
  @endforeach
</table>
