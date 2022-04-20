<?php
/**
 * @var App\Domain $model
 * @var \Illuminate\Support\Collection|\App\Services\YandexPdd\DnsRecord[] $records
 */
?>

@extends("$tpl.base")

@section('content')
@if(sizeof($records))
  <table class="table-stats">
    <thead>
      <tr>
        <th>Хост</th>
        <th class="text-center">Тип</th>
        <th>Значение записи</th>
        <th></th>
      </tr>
    </thead>
    <tr class="ns-record-container" data-action="{{ path([$controller, 'addNsRecord'], $model) }}">
      <td>
        <input class="form-input text-right" type="text" name="subdomain" value="@">
      </td>
      <td>
        <select class="form-input" name="type">
          @foreach(App\Services\YandexPdd\DnsRecordType::cases() as $dnsRecordType)
            @if(!$dnsRecordType->canBeAdded())
              @continue
            @endif
            <option value="{{ $dnsRecordType->value }}">{{ $dnsRecordType->name }}</option>
          @endforeach
        </select>
      </td>
      <td>
        <input class="form-input" type="text" name="content">
        <input class="form-input mt-1" type="text" name="priority" placeholder="priority [MX, SRV]">
        <input class="form-input mt-1" type="text" name="port" placeholder="port [SRV]">
        <input class="form-input mt-1" type="text" name="weight" placeholder="weight [SRV]">
      </td>
      <td>
        <a class="btn btn-default js-ns-record-add" href="#">добавить</a>
      </td>
    </tr>
    @foreach ($records as $record)
      <tr class="ns-record-container">
        <td>
          <div class="presentation text-right">
            {{ $record->subdomain }}
          </div>
          <div hidden class="edit">
            <input class="form-input text-right" type="text" name="subdomain" value="{{ $record->subdomain }}">
          </div>
        </td>
        <td class="text-center">
          {{ $record->type->value }}
          <input type="hidden" name="type" value="{{ $record->type->value }}">
        </td>
        <td>
          <div class="presentation">
            {{ str($record->content)->limit(35) }}
            @if ($record->type->isCname() && $model->isIdn($record->content))
              <br><span class="text-muted">{{ idn_to_utf8($record->content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46) }}</span>
            @endif
            @if ($record->priority)
              <br><span class="text-muted">priority</span>: {{ $record->priority }}
            @endif
            @if($record->port)
              <br><span class="text-muted">port</span>: {{ $record->port }}
            @endif
            @if($record->weight)
              <br><span class="text-muted">weight</span>: {{ $record->weight }}
            @endif
            @if($record->retry)
              <br><span class="text-muted">retry</span>: {{ $record->retry }}
            @endif
            @if($record->refresh)
              <br><span class="text-muted">refresh</span>: {{ $record->refresh }}
            @endif
            @if($record->expire)
              <br><span class="text-muted">expire</span>: {{ $record->expire }}
            @endif
            @if ($record->ttl !== 3600)
              <br><span class="text-muted">ttl</span>: {{ $record->ttl }}
            @endif
          </div>
          <div hidden class="edit">
            <input class="form-input" type="text" name="content" value="{{ $record->content }}" {{ $record->type->isSoa() ? 'readonly' : '' }}>
            @if ($record->priority)
              <input class="form-input mt-1" type="text" name="priority" value="{{ $record->priority }}" placeholder="priority">
            @endif
            @if($record->port)
              <input class="form-input mt-1" type="text" name="port" value="{{ $record->port }}" placeholder="port">
            @endif
            @if($record->weight)
              <input class="form-input mt-1" type="text" name="weight" value="{{ $record->weight }}" placeholder="weight">
            @endif
            @if($record->retry)
              <input class="form-input mt-1" type="text" name="retry" value="{{ $record->retry }}" placeholder="retry">
            @endif
            @if($record->refresh)
              <input class="form-input mt-1" type="text" name="refresh" value="{{ $record->refresh }}" placeholder="refresh">
            @endif
            @if($record->expire)
              <input class="form-input mt-1" type="text" name="expire" value="{{ $record->expire }}" placeholder="expire">
            @endif
            @if($record->ttl)
              <input class="form-input mt-1" type="text" name="ttl" value="{{ $record->ttl }}" placeholder="ttl">
            @endif
            <input type="hidden" name="record_id" value="{{ $record->id }}">
            @method('put')
          </div>
        </td>
        <td>
          <div class="presentation">
            <a class="pseudo js-ns-record-edit mr-2" href="#">настроить</a>
            <a
              class="pseudo js-ns-record-delete"
              data-id="{{ $record->id }}"
              data-action="{{ path([$controller, 'deleteNsRecord'], $model) }}"
              href="#"
            >
              @svg (times)
            </a>
          </div>
          <div hidden class="edit">
            <a
              class="pseudo js-ns-record-save mr-2"
              data-action="{{ path([$controller, 'editNsRecord'], $model) }}"
              href="#"
            >сохранить</a>
            <a class="pseudo js-ns-record-cancel" href="#">
              @svg (rotate-left)
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  </table>
@elseif ($model->yandex_user_id)
  <x-alert-warning>
    ДНС-записи не найдены.
  </x-alert-warning>
@endif
@endsection
