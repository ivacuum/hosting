@include('tpl.form_errors')

{!! Form::text('kanji_string')->html() !!}

<div class="form-group form-row">
  <label class="col-md-4 md:tw-text-right">Есть в кандзи</label>
  <div class="col-md-8">
    @php ($kanjis = $model->kanjis->pluck('id')->all())
    @foreach (App\Kanji::orderBy('level')->orderBy('meaning')->get(['id', 'character', 'meaning']) as $row)
      <label class="form-check">
        <input class="form-check-input" type="checkbox" name="kanjis[]" value="{{ $row->id }}" {{ in_array($row->id, (array) old('kanjis', $kanjis)) ? 'checked' : '' }}>
        <span class="form-check-label">
          {{ $row->character }}
          <span class="text-muted">{{ $row->firstMeaning() }}</span>
        </span>
      </label>
    @endforeach
  </div>
</div>
