<?php
/**
 * @var App\Domain $model
 * @var \Illuminate\Support\Collection|\App\Services\YandexPdd\DnsRecord[] $records
 */
?>

@extends("acp.domains.base")
@include('livewire')

@section('content')
@if(sizeof($records))
  <table class="table-stats">
    <thead>
      <tr class="text-left">
        <th>Тип</th>
        <th>Хост</th>
        <th>Значение записи</th>
        <th></th>
      </tr>
    </thead>
    @foreach ($records as $record)
      <tr>
        <td>{{ $record->type->value }}</td>
        <td>{{ $record->subdomain }}</td>
        <td>
          <div>
            {{ str($record->content)->limit(35) }}
            @if ($record->type->isCname() && $model->isIdn($record->content))
              <div><span class="text-muted">{{ idn_to_utf8($record->content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46) }}</span></div>
            @endif
            @if ($record->priority)
              <div><span class="text-muted">priority</span>: {{ $record->priority }}</div>
            @endif
            @if($record->port)
              <div><span class="text-muted">port</span>: {{ $record->port }}</div>
            @endif
            @if($record->weight)
              <div><span class="text-muted">weight</span>: {{ $record->weight }}</div>
            @endif
            @if($record->retry)
              <div><span class="text-muted">retry</span>: {{ $record->retry }}</div>
            @endif
            @if($record->refresh)
              <div><span class="text-muted">refresh</span>: {{ $record->refresh }}</div>
            @endif
            @if($record->expire)
              <div><span class="text-muted">expire</span>: {{ $record->expire }}</div>
            @endif
            @if ($record->ttl !== 3600)
              <div><span class="text-muted">ttl</span>: {{ $record->ttl }}</div>
            @endif
          </div>
        </td>
        <td>
          <a class="mr-2" href="{{ path([App\Http\Controllers\Acp\YandexPddDnsRecordController::class, 'edit'], [$model, 'id' => $record->id]) }}">редактировать</a>
          <form class="inline" method="POST" action="{{ path([App\Http\Controllers\Acp\YandexPddDnsRecordController::class, 'destroy'], [$model, 'id' => $record->id]) }}" onsubmit="return confirm('Запись будет удалена. Продолжить?')">
            @method('DELETE')
            @csrf
            <button class="pseudo">
              @svg (times)
            </button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>

  <h3 class="mt-12">Добавить днс-запись</h3>
  @livewire(App\Http\Livewire\DnsRecordForm::class, ['domain' => $model])
@elseif ($model->yandex_user_id)
  <x-alert-warning>
    ДНС-записи не найдены.
  </x-alert-warning>
@endif
@endsection
