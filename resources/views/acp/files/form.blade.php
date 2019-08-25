@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::text('folder')->html() !!}

{!! Form::radio('status')->required()->values([
  App\File::STATUS_HIDDEN => 'Скрыт',
  App\File::STATUS_PUBLISHED => 'Опубликован',
])->html() !!}

<div class="mb-4">
  <label>{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
  <div class="custom-file">
    <input class="custom-file-input {{ $errors->has('file') ? 'is-invalid' : '' }}" type="file" name="file">
    <label class="custom-file-label">Выберите файл...</label>
  </div>
  @if ($errors->has('file'))
    <div class="invalid-feedback block">{{ $errors->first('file') }}</div>
  @endif
  <div class="form-help">Не более 100 МБ</div>
</div>
