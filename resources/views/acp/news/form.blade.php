@include('tpl.form_errors')

{{ Form::text('title')->required() }}

{{ Form::radio('status')->required()->values(App\Domain\NewsStatus::labels()) }}

{{ Form::textarea('markdown')->wide()->required() }}
