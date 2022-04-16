@include('tpl.form_errors')

{{ Form::radio('status')->required()->values(App\Domain\CommentStatus::labels()) }}

{{ Form::textarea('html')->wide()->required() }}
