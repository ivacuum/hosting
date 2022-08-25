@extends('base')
@include('livewire')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Обратная связь')</h1>
<div class="max-w-[600px]">
  @ru
    <p>Используйте форму ниже, чтобы задать вопрос, оставить отзыв, получить помощь или подсказать как сделать сайт лучше.</p>
  @en
    <p>Use the form below to ask a question, leave a feedback, or tell us how to make the site better.</p>
  @endru
  @livewire(App\Http\Livewire\FeedbackForm::class)
</div>
@endsection
