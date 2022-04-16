@include('tpl.form_errors')

{{ Form::text('name')->required() }}
{{ Form::text('email') }}
{{ Form::textarea('text')->wide() }}
