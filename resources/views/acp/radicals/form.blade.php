<?php
/** @var App\Radical $model */
?>

@include('tpl.form_errors')

{!! Form::text('kanji_string')->html() !!}

<div class="mb-4">
  <label class="font-bold">Есть в кандзи</label>
  <?php $kanjis = $model->kanjis->modelKeys() ?>
  @foreach (App\Kanji::orderBy('level')->orderBy('meaning')->get(['id', 'character', 'meaning']) as $row)
    <label class="flex items-center">
      <input
        class="form-checkbox mr-2"
        type="checkbox"
        name="kanjis[]"
        value="{{ $row->id }}"
        {{ in_array($row->id, (array) old('kanjis', $kanjis)) ? 'checked' : '' }}
      >
      <span class="mr-1">{{ $row->character }}</span>
      <span class="text-muted">{{ $row->firstMeaning() }}</span>
    </label>
  @endforeach
</div>
