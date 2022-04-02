@extends('base')

@section('content')
<h1 class="h2">@lang('Обратная связь')</h1>
<div class="max-w-[600px]">
  @ru
    <p>Используйте форму ниже, чтобы задать вопрос, оставить отзыв, получить помощь или подсказать как сделать сайт лучше.</p>
  @en
    <p>Use the form below to ask a question, leave a feedback, or tell us how to make the site better.</p>
  @endru
  <feedback-form
    name="{{ Auth::user()?->login }}"
    email="{{ Auth::user()?->email }}"
    action="@lng/contact"
  ></feedback-form>
</div>
@endsection
