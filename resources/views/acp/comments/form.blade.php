@include('tpl.form_errors')

{{ Form::radio('status')->required()->values(App\Domain\CommentStatus::labels())->html() }}

{{ Form::textarea('html')->wide()->required()->html() }}
