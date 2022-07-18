<?php /** @var \App\Magnet $model */ ?>

@extends('acp.show')
@include('livewire')

@section('content')
<?php $relatedTorrents = $model->relatedTorrents() ?>
@if ($relatedTorrents?->count())
  <h4>
    @lang('Связанные раздачи')
    <span class="text-base text-muted">{{ $relatedTorrents->count() }}</span>
  </h4>
  <ol class="mb-4">
    @foreach ($relatedTorrents as $row)
      <li><a href="{{ path([App\Http\Controllers\Acp\Magnets::class, 'show'], $row) }}">{{ $row->shortTitle() }}</a></li>
    @endforeach
  </ol>
@endif

<div class="border dark:border-slate-600 sm:rounded-lg">
  <div class="px-4 py-5 sm:p-6">
    <h4 class="h4">
      Заменить раздачу после удаления
    </h4>
    <div class="text-sm text-gray-500">
      <p>В конце топика модератор обычно оставляет ссылку на новую раздачу.</p>
    </div>
    @livewire(App\Http\Livewire\MagnetReplaceForm::class, ['magnet' => $model])
  </div>
</div>
@parent
@endsection
