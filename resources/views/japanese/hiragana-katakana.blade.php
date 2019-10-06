@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.hiragana-katakana') }}</h1>
<hiragana-katakana></hiragana-katakana>

<div class="mt-12 max-w-600px">
  <div class="h3 mt-12">{{ trans('issues.create') }}</div>
  @ru
    <p>Поделитесь своим опытом использования тренажера или задайте вопрос. Мы постараемся обработать информацию и сделать тренажер еще лучше. <span class="whitespace-no-wrap">ありがとうございます。</span></p>
  @en
    <p>Use the form below to ask a question or share your thoughts. We will use your feedback to make the trainer better. There are certainly things to improve. <span class="whitespace-no-wrap">ありがとうございます。</span></p>
  @endru
  <feedback-form
    email="{{ Auth::user()->email ?? '' }}"
    title="Hiragana Katakana Trainer"
    action="{{ path([App\Http\Controllers\Issues::class, 'store']) }}"
    hide-title
  ></feedback-form>
</div>
@endsection
