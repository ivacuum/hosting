<table>
  @foreach ($glyphs as $glyph)
    <tr>
      <td class="pr-4">
        @ru
          {{ $glyph['ru'] }}
        @en
          {{ $glyph['en'] }}
        @endru
      </td>
      <td class="f28">
        <ruby class="tooltipped tooltipped-e" aria-label="{{ $glyph['phonetic'] }}">
          {{ $glyph['jp'] }}
          @if (isset($glyph['hiragana']))
            <rt class="text-muted f16">{{ $glyph['hiragana'] }}</rt>
          @endif
        </ruby>
      </td>
    </tr>
  @endforeach
</table>
