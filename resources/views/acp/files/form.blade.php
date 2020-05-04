@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::text('folder')->html() !!}

{!! Form::radio('status')->required()->values([
  App\File::STATUS_HIDDEN => 'Скрыт',
  App\File::STATUS_PUBLISHED => 'Опубликован',
])->html() !!}

<div class="mb-4">
  <label class="font-bold">{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
  <input class="block w-full" type="file" name="file">
  <x-invalid-feedback field="file"/>
  <div class="form-help">Не более 100 МБ</div>
</div>
