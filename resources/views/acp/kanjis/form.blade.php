@include('tpl.form_errors')

{!! Form::text('similar_kanji')->default($model->exists ? $model->similar->pluck('character')->implode('') : '')->html() !!}

<div class="mb-4">
  <label class="font-bold">Состоит из ключей</label>
  @php ($radicals = $model->radicals->pluck('id')->all())
  @foreach (App\Radical::orderBy('level')->orderBy('meaning')->get(['id', 'character', 'meaning']) as $row)
    <label class="flex items-center">
      <input
        class="mr-2"
        type="checkbox"
        name="radicals[]"
        value="{{ $row->id }}"
        {{ in_array($row->id, (array) old('radicals', $radicals)) ? 'checked' : '' }}
      >
      <span class="mr-1">{{ $row->character }}</span>
      <span class="text-muted">{{ $row->meaning }}</span>
    </label>
  @endforeach
</div>
