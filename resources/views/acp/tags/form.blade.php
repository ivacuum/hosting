@include('tpl.form_errors')

{{ Form::text('title_ru')->required() }}
{{ Form::text('title_en')->required() }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
