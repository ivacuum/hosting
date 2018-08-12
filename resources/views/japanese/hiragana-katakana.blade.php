@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.hiragana-katakana') }}</h1>
<hiragana-katakana></hiragana-katakana>

<div class="mt-5 mw-600">
  <div class="h3 mt-5">{{ trans('issues.create') }}</div>
  @ru
    <p>Поделитесь своим опытом использования тренажера или задайте вопрос. Мы постараемся обработать информацию и сделать тренажер еще лучше. <span class="text-nowrap">ありがとうございます。</span></p>
  @en
    <p>Use the form below to ask a question or share your thoughts. We will use your feedback to make the trainer better. There are certainly things to improve. <span class="text-nowrap">ありがとうございます。</span></p>
  @endru
  <feedback-form
    email="{{ Auth::user()->email ?? '' }}"
    title="Hiragana Katakana Trainer"
    action="{{ path('Issues@store') }}"
    hide-title
  ></feedback-form>
</div>
@endsection
