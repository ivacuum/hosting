@include('tpl.form_errors')

{!! Form::text('similar_kanji')->default($model->exists ? $model->similar->pluck('character')->implode('') : '')->html() !!}

<div class="form-group form-row">
  <label class="col-md-4 md:tw-text-right">Состоит из ключей</label>
  <div class="col-md-8">
    @php ($radicals = $model->radicals->pluck('id')->all())
    @foreach (App\Radical::orderBy('level')->orderBy('meaning')->get(['id', 'character', 'meaning']) as $row)
      <label class="form-check">
        <input class="form-check-input" type="checkbox" name="radicals[]" value="{{ $row->id }}" {{ in_array($row->id, (array) old('radicals', $radicals)) ? 'checked' : '' }}>
        <span class="form-check-label">
          {{ $row->character }}
          <span class="text-muted">{{ $row->meaning }}</span>
        </span>
      </label>
    @endforeach
  </div>
</div>
