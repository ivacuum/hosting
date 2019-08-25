<div class="flex flex-wrap text-center">
  @foreach ($glyphs as $glyph)
    <div class="self-end mb-6 mr-6">
      <div class="text-4xl">
        @if (is_array($glyph['jp']))
          <ruby>
            @foreach ($glyph['jp'] as $kanji => $kana)
              <rb>{{ $kanji }}</rb>
              <rt class="text-2xl text-muted">{{ $kana }}</rt>
            @endforeach
          </ruby>
        @else
          <ruby>
            {{ $glyph['jp'] }}
            <rt class="text-2xl text-muted">{{ $glyph['kana'] ?? '' }}</rt>
          </ruby>
        @endif
      </div>
      <div class="text-muted">
        @ru
          {{ $glyph['ru'] }}
        @en
          {{ $glyph['en'] }}
        @endru
      </div>
    </div>
  @endforeach
</div>
