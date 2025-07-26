<?php /** @var \App\Domain\SocialMedia\Models\SocialMediaPost $model */ ?>

@extends('acp.list')

@section('heading-after-search')
  @include('acp.tpl.dropdown-filter', [
    'field' => 'status',
    'values' => [
      \App\Domain\SocialMedia\SocialMediaPostStatus::Queued->i18n() => \App\Domain\SocialMedia\SocialMediaPostStatus::Queued->value,
      \App\Domain\SocialMedia\SocialMediaPostStatus::Published->i18n() => \App\Domain\SocialMedia\SocialMediaPostStatus::Published->value,
      \App\Domain\SocialMedia\SocialMediaPostStatus::Excluded->i18n() => \App\Domain\SocialMedia\SocialMediaPostStatus::Excluded->value,
    ]
  ])
@endsection

@section('content-list')
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <x-th-sortable key="id" />
      <x-th key="photo_id" />
      <x-th key="caption" />
      <x-th key="status" />
      <x-th-sortable key="published_at" defaultOrder="asc" />
    </tr>
    </thead>
    <tbody>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
        <td class="md:text-right">
          <a href="{{ Acp::show($model) }}">
            {{ $model->id }}
          </a>
        </td>
        <td class="text-center">
          <a class="inline-block screenshot-link" href="{{ Acp::show($model) }}">
            <img
              class="border border-hover image-100 object-cover"
              src="{{ $model->photo->thumbnailUrl() }}"
              alt=""
            >
          </a>
        </td>
        <td>{{ $model->caption }}</td>
        <td>{{ $model->status->i18n() }}</td>
        <td>{{ $model->published_at?->isoFormat('LLL') }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
