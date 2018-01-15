@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('url')->required()->html() !!}

<div class="form-group form-row">
  <label class="col-md-4 col-form-label text-md-right">Обработчик</label>
  <div class="col-md-6">
    <div class="input-group">
      <input class="form-control" type="text" name="handler" value="{{ old('handler', @$model->handler) }}">
      <div class="input-group-append">
        <span class="input-group-text border-right-0">@</span>
      </div>
      <input class="form-control" type="text" name="method" value="{{ old('method', @$model->method) }}">
    </div>
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
