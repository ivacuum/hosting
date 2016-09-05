@extends('acp.base', [
  'meta_title' => $filter ? trans("meta_title.acp.domains.{$filter}") : trans('meta_title.acp.domains.default'),
])

@section('content')
<ul class="nav nav-link-tabs">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => '', 'page' => 1]) }}">
      На мониторинге
    </a>
  </li>
  <li class="{{ $filter == 'orphan' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'orphan', 'page' => 1]) }}">
      На продажу
    </a>
  </li>
  <li class="{{ $filter == 'external' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'external', 'page' => 1]) }}">
      Не в нашей панели reg.ru
    </a>
  </li>
  <li class="{{ $filter == 'no-server' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'no-server', 'page' => 1]) }}">
      Без сервера
    </a>
  </li>
  <li class="{{ $filter == 'no-ns' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'no-ns', 'page' => 1]) }}">
      Без NS
    </a>
  </li>
  <li class="{{ $filter == 'inactive' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'inactive', 'page' => 1]) }}">
      Неактивные
    </a>
  </li>
  <li class="{{ $filter == 'trashed' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'trashed', 'page' => 1]) }}">
      Удаленные
    </a>
  </li>
</ul>

@include("$tpl.list")
@endsection
