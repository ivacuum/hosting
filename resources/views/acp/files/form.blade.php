@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::text('project')->html() !!}
{!! Form::text('folder')->html() !!}
