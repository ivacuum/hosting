@include('tpl.form_errors')

{{ Form::text('title')->required()->html() }}
{{ Form::text('slug')->required()->html() }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
