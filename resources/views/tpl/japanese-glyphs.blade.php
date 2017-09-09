<div class="d-flex flex-wrap text-center">
  @foreach ($glyphs as $glyph)
    <div class="align-self-end mb-4 mr-4">
      <div class="f36">
        <ruby>
          {{ $glyph['jp'] }}
          <rt class="f24 text-muted">{{ $glyph['kana'] ?? '' }}</rt>
        </ruby>
      </div>
      <div>
        @ru
          {{ $glyph['ru'] }}
        @en
          {{ $glyph['en'] }}
        @endru
      </div>
    </div>
  @endforeach
</div>
