@extends('acp.list', [
  'metaTitle' => $filter ? __("meta_title.acp.domains.{$filter}") : __('meta_title.acp.domains.default'),
  'searchForm' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'filter',
  'values' => [
    'На мониторинге' => null,
    'На продажу' => 'orphan',
    'Не в нашей пашели reg.ru' => 'external',
    'Без сервера' => 'no-server',
    'Без NS' => 'no-ns',
    'Неактивные' => 'inactive',
    'Удаленные' => 'trashed',
  ]
])
@endsection

@section('content-list')
@include("$tpl.list")
@endsection
