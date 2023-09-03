@extends('korean.base')
@include('livewire')

@section('content')
@livewire(App\Livewire\HangulTrainer::class)

<div class="mt-12 max-w-xl mx-auto">
  <div class="font-medium text-2xl mb-2 mt-12">@lang('Обратная связь')</div>
  @ru
    <p>Поделитесь своим опытом использования тренажера или задайте вопрос. Мы постараемся обработать информацию и сделать тренажер еще лучше.</p>
  @en
    <p>Use the form below to ask a question or share your thoughts. We will use your feedback to make the trainer better. There are certainly things to improve.</p>
  @endru
  @livewire(App\Livewire\FeedbackForm::class, [
    'title' => 'Hangul Trainer',
    'hideTitle' => true,
  ])
</div>
@endsection
