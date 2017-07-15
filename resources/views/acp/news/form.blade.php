@include('tpl.form_errors')

<div class="form-group {{ $errors->has('site_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Сайт:</label>
  <div class="col-md-6">
    <div class="form-select">
      <select class="form-control" name="site_id">
        <option value="0">—</option>
        <option value="11" {{ old('site_id', @$model->site_id) === 11 ? 'selected' : '' }}>ivacuum.ru [ru]</option>
        <option value="12" {{ old('site_id', @$model->site_id) === 12 ? 'selected' : '' }}>ivacuum.ru [en]</option>
      </select>
    </div>
  </div>
</div>

{!! Form::text('title')->required()->html() !!}

{!! Form::radio('status')->required()->values([
  App\News::STATUS_HIDDEN => 'Скрыта',
  App\News::STATUS_PUBLISHED => 'Опубликована',
])->html() !!}

{!! Form::textarea('html')->wide()->required()->html() !!}
