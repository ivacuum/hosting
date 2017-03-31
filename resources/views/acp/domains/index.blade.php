@extends('acp.base', [
  'meta_title' => $filter ? trans("meta_title.acp.domains.{$filter}") : trans('meta_title.acp.domains.default'),
])

@section('content')
<ul class="nav nav-link-tabs">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => null]) }}">
      На мониторинге
    </a>
  </li>
  <li class="{{ $filter == 'orphan' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'orphan']) }}">
      На продажу
    </a>
  </li>
  <li class="{{ $filter == 'external' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'external']) }}">
      Не в нашей панели reg.ru
    </a>
  </li>
  <li class="{{ $filter == 'no-server' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'no-server']) }}">
      Без сервера
    </a>
  </li>
  <li class="{{ $filter == 'no-ns' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'no-ns']) }}">
      Без NS
    </a>
  </li>
  <li class="{{ $filter == 'inactive' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'inactive']) }}">
      Неактивные
    </a>
  </li>
  <li class="{{ $filter == 'trashed' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'trashed']) }}">
      Удаленные
    </a>
  </li>
</ul>

@include("$tpl.list")
@endsection
