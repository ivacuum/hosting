@extends('base')

@section('content')
<h1 class="h2">{{ trans('issues.create') }}</h1>
<div class="row">
  <div class="col-lg-6">
    @ru
      <p>Используйте форму ниже, чтобы задать вопрос, оставить отзыв, получить помощь или подсказать как сделать сайт лучше.</p>
    @en
      <p>Use the form below to ask a question, leave a feedback, or tell us how to make the site better.</p>
    @endru
    <feedback-form
      name="{{ optional(Auth::user())->login }}"
      email="{{ optional(Auth::user())->email }}"
      action="{{ path('Issues@store') }}"
    ></feedback-form>
  </div>
</div>
@endsection
