@extends('acp.base', [
  'meta_title' => $filter ? trans("meta_title.acp.domains.{$filter}") : trans('meta_title.acp.domains.default'),
])

@section('content')
<ul class="nav nav-link-tabs">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => '', 'page' => null]) }}">
      На мониторинге
    </a>
  </li>
  <li class="{{ $filter == 'orphan' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'orphan', 'page' => null]) }}">
      На продажу
    </a>
  </li>
  <li class="{{ $filter == 'external' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'external', 'page' => null]) }}">
      Не в нашей панели reg.ru
    </a>
  </li>
  <li class="{{ $filter == 'no-server' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'no-server', 'page' => null]) }}">
      Без сервера
    </a>
  </li>
  <li class="{{ $filter == 'no-ns' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'no-ns', 'page' => null]) }}">
      Без NS
    </a>
  </li>
  <li class="{{ $filter == 'inactive' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'inactive', 'page' => null]) }}">
      Неактивные
    </a>
  </li>
  <li class="{{ $filter == 'trashed' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'trashed', 'page' => null]) }}">
      Удаленные
    </a>
  </li>
</ul>

@include("$tpl.list")
@endsection
