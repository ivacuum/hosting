@include('tpl.form_errors')

{{ Form::text('title_ru')->required()->html() }}
{{ Form::text('title_en')->required()->html() }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
