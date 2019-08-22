@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::text('folder')->html() !!}

{!! Form::radio('status')->required()->values([
  App\File::STATUS_HIDDEN => 'Скрыт',
  App\File::STATUS_PUBLISHED => 'Опубликован',
])->html() !!}

<div class="form-group form-row">
  <label class="col-md-4 col-form-label md:tw-text-right">{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
  <div class="col-md-6">
    <div class="custom-file">
      <input class="custom-file-input {{ $errors->has('file') ? 'is-invalid' : '' }}" type="file" name="file">
      <label class="custom-file-label">Выберите файл...</label>
    </div>
    @if ($errors->has('file'))
      <div class="invalid-feedback tw-block">{{ $errors->first('file') }}</div>
    @endif
    <div class="form-help">Не более 100 МБ</div>
  </div>
</div>
