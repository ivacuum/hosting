@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'provider',
  'values' => [
    'Все' => null,
    '---' => null,
    'ВК' => Ivacuum\Generic\Models\ExternalIdentity::VK,
    'Гитхаб' => Ivacuum\Generic\Models\ExternalIdentity::GITHUB,
    'Гугл' => Ivacuum\Generic\Models\ExternalIdentity::GOOGLE,
    'Твиттер' => Ivacuum\Generic\Models\ExternalIdentity::TWITTER,
    'Фэйсбук' => Ivacuum\Generic\Models\ExternalIdentity::FACEBOOK,
    'Яндекс' => Ivacuum\Generic\Models\ExternalIdentity::YANDEX,
  ]
])
@endsection

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
      <td class="leading-none text-2xl bg-{{ $model->provider }}-600 hover:bg-{{ $model->provider }}-700">
        <a class="text-white hover:text-white" href="{{ $model->externalLink() }}">
          @svg ($model->provider)
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
