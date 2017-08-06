@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::text('folder')->html() !!}

{!! Form::radio('status')->required()->values([
  App\File::STATUS_HIDDEN => 'Скрыт',
  App\File::STATUS_PUBLISHED => 'Опубликован',
])->html() !!}

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label">{{ ViewHelper::modelFieldTrans('file', 'file') }}:</label>
  <div class="col-md-6">
    <label class="custom-file">
      <input class="custom-file-input" type="file" name="file">
      <span class="custom-file-control"></span>
    </label>
    <span class="help-block">Не более 100 МБ</span>
    @if ($errors->has('file'))
      <span class="help-block">{{ $errors->first('file') }}</span>
    @endif
  </div>
</div>
