@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('url')->required()->html() !!}

<div class="mb-4">
  <label class="font-bold">Обработчик</label>
  <div class="flex items-center w-full">
    <input class="form-control" type="text" name="handler" value="{{ old('handler', @$model->handler) }}">
    <div class="mx-2">@</div>
    <input class="form-control" type="text" name="method" value="{{ old('method', @$model->method) }}">
  </div>
</div>

{!! Form::textarea('html')->wide()->html() !!}

{!! Form::checkbox('status')
  ->label('')
  ->default(0)
  ->values([1 => 'Отображается на сайте'])
  ->html() !!}

{!! Form::text('middleware')->html() !!}
{!! Form::text('redirect')->html() !!}
{!! Form::text('meta_title')->html() !!}
{!! Form::text('meta_keywords')->html() !!}
{!! Form::text('meta_description')->help('до 255 знаков')->html() !!}
