<?php /** @var \App\Magnet $model */ ?>

@extends('acp.show')
@include('livewire')

@section('content')
<?php $relatedTorrents = $model->relatedTorrents() ?>
@if ($relatedTorrents?->count())
  <div class="font-medium text-xl">
    @lang('Связанные раздачи')
    <span class="text-base text-muted">{{ $relatedTorrents->count() }}</span>
  </div>
  <div><span class="text-muted">Запрос:</span> {{ $model->related_query }}</div>
  <ol class="mb-4">
    @foreach ($relatedTorrents as $row)
      <li><a href="{{ Acp::show($row) }}">{{ $row->shortTitle() }}</a></li>
    @endforeach
  </ol>
@endif

<div class="border dark:border-slate-600 sm:rounded-lg">
  <div class="px-4 py-5 sm:p-6">
    <div class="font-medium text-xl mb-2">
      Заменить раздачу после удаления
    </div>
    <div class="text-sm text-gray-500">
      <p>В конце топика модератор обычно оставляет ссылку на новую раздачу.</p>
    </div>
    @livewire(App\Http\Livewire\MagnetReplaceForm::class, ['magnet' => $model])
  </div>
</div>
@parent
@endsection
