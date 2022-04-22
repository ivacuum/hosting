<?php
/**
 * @var \App\Services\YandexPdd\DnsRecord $record
 */
?>

@extends('acp.domains.base')
@include('livewire')

@section('content')
@livewire(App\Http\Livewire\DnsRecordForm::class, [
  'ttl' => $record->ttl,
  'port' => $record->port,
  'type' => $record->type->value,
  'domain' => $model,
  'weight' => $record->weight,
  'content' => $record->content ?? $record->target,
  'priority' => $record->priority,
  'recordId' => $record->id,
  'subdomain' => $record->subdomain,
])
@endsection
