@include('tpl.form_errors')

{{ Form::text('title')->required() }}
{{ Form::text('slug')->required() }}
{{ Form::text('folder') }}

{{ Form::radio('status')->required()->values(App\Domain\FileStatus::labels()) }}

<div class="mb-4">
  <label class="font-bold">{{ ViewHelper::modelFieldTrans('file', 'file') }}</label>
  <input class="block w-full" type="file" name="file">
  <x-invalid-feedback field="file"/>
  <div class="form-help">Не более 100 МБ</div>
</div>
