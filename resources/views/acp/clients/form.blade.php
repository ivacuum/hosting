@include('tpl.form_errors')

{{ Form::text('name')->required()->html() }}
{{ Form::text('email')->html() }}
{{ Form::textarea('text')->wide()->html() }}
