@include('tpl.form_errors')

{!! Form::text('title')->required()->html() !!}

{!! Form::radio('status')->required()->values(App\Domain\NewsStatus::labels())->html() !!}

{!! Form::textarea('markdown')->wide()->required()->html() !!}
