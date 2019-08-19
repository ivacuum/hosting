<div class="d-flex flex-wrap tw-text-center">
  @foreach ($glyphs as $glyph)
    <div class="align-self-end tw-mb-6 tw-mr-6">
      <div class="f36">
        @if (is_array($glyph['jp']))
          <ruby>
            @foreach ($glyph['jp'] as $kanji => $kana)
              <rb>{{ $kanji }}</rb>
              <rt class="f24 text-muted">{{ $kana }}</rt>
            @endforeach
          </ruby>
        @else
          <ruby>
            {{ $glyph['jp'] }}
            <rt class="f24 text-muted">{{ $glyph['kana'] ?? '' }}</rt>
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
