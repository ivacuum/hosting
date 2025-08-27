<?php /** @var App\ExternalIdentity $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'provider',
  'values' => [
    'Все' => null,
    '---' => null,
    'ВК' => App\Domain\ExternalIdentityProvider::Vk->value,
    'Гитхаб' => App\Domain\ExternalIdentityProvider::GitHub->value,
    'Гугл' => App\Domain\ExternalIdentityProvider::Google->value,
    'Твиттер' => App\Domain\ExternalIdentityProvider::Twitter->value,
    'Фэйсбук' => App\Domain\ExternalIdentityProvider::Facebook->value,
    'Яндекс' => App\Domain\ExternalIdentityProvider::Yandex->value,
  ]
])
@endsection

{{-- Для компиляции tailwindcss }}
{{-- bg-yandex-600 bg-yandex-700 --}}
{{-- bg-github-600 bg-github-700 --}}

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <th></th>
    <x-th key="user_id"/>
    <x-th key="updated_at"/>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr>
      <td class="md:text-right">
        <a href="{{ Acp::show($model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td class="leading-none text-2xl bg-{{ $model->provider->value }}-600 hover:bg-{{ $model->provider->value }}-700">
        <?php $icon = $model->provider->value ?>
        <a class="text-white hover:text-white" href="{{ $model->externalLink() }}">
          @svg ($icon)
        </a>
      </td>
      <td>
        @if ($model->user_id)
          <a href="{{ Acp::show($model->user) }}">{{ $model->user->email }}</a>
        @else
          {{ $model->email }}
        @endif
      </td>
      <td>{{ ViewHelper::dateShort($model->updated_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
