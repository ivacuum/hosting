@extends('acp.base', [
  'meta_title' => $filter ? trans("meta_title.acp.domains.{$filter}") : trans('meta_title.acp.domains.default'),
])

@section('content')
<ul class="list-inline" style="margin: 0 0 0.5em;">
  <li><h4>Домены:</h4></li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => '', 'page' => 1]) }}" class="link js-pjax {{ !$filter ? 'active' : '' }}">
        На мониторинге
      </a>
    </h4>
  </li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => 'orphan', 'page' => 1]) }}" class="link js-pjax {{ $filter == 'orphan' ? 'active' : '' }}">
        На продажу
      </a>
    </h4>
  </li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => 'external', 'page' => 1]) }}" class="link js-pjax {{ $filter == 'external' ? 'active' : '' }}">
        Не в нашей панели reg.ru
      </a>
    </h4>
  </li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => 'no-server', 'page' => 1]) }}" class="link js-pjax {{ $filter == 'no-server' ? 'active' : '' }}">
        Без сервера
      </a>
    </h4>
  </li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => 'no-ns', 'page' => 1]) }}" class="link js-pjax {{ $filter == 'no-ns' ? 'active' : '' }}">
        Без NS
      </a>
    </h4>
  </li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => 'inactive', 'page' => 1]) }}" class="link js-pjax {{ $filter == 'inactive' ? 'active' : '' }}">
        Неактивные
      </a>
    </h4>
  </li>
  <li>
    <h4>
      <a href="{{ Request::fullUrlWithQuery(['filter' => 'trashed', 'page' => 1]) }}" class="link js-pjax {{ $filter == 'trashed' ? 'active' : '' }}">
        Удаленные
      </a>
    </h4>
  </li>
</ul>

@include("$tpl.list")
@endsection
