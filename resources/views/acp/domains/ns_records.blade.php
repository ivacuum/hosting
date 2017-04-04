@extends("$tpl.base")

@section('content')
{{--
@if ($model->domain_control and ($model->ns != 'dns1.yandex.net dns2.yandex.net' and $model->ns != 'dns1.yandex.ru dns2.yandex.ru'))
  <form action="{{ path("$self@setYandexNs", $model) }}" method="post">
    <p>
      <button type="submit" class="btn btn-default">
        Установить DNS Яндекса
      </button>
    </p>
		{{ csrf_field() }}
  </form>
@endif

@if (!$model->yandex_user_id)
  <form action="{{ path("$self@setYandexPdd", $model) }}" method="post">
    <p>
      <button type="submit" class="btn btn-default">
        Подключить Яндекс.Почту для домена
      </button>
    </p>
		{{ csrf_field() }}
  </form>
@endif
--}}

@if (sizeof($records))
  <table class="table-stats">
    <thead>
      <tr>
        <th>Хост</th>
        <th class="text-center">Тип</th>
        <th>Значение записи</th>
        <th></th>
      </tr>
    </thead>
    <tr class="ns-record-container" data-action="{{ path("$self@addNsRecord", $model) }}">
      <td class="text-right">
        <input type="text" name="subdomain" value="@" class="text-right w-100">
      </td>
      <td class="text-center">
        <select name="type">
          <option value="A" selected>A</option>
          <option value="CNAME">CNAME</option>
          <option value="AAAA">AAAA</option>
          <option value="TXT">TXT</option>
          <option value="NS">NS</option>
          <option value="MX">MX</option>
          <option value="SRV">SRV</option>
        </select>
      </td>
      <td>
        <input class="w-100" type="text" name="content">
        <br><input class="w-100" type="text" name="priority" placeholder="priority [MX, SRV]">
        <br><input class="w-100" type="text" name="port" placeholder="port [SRV]">
        <br><input class="w-100" type="text" name="weight" placeholder="weight [SRV]">
      </td>
      <td>
        <a class="pseudo js-ns-record-add">добавить днс-запись</a>
      </td>
    </tr>
    @foreach ($records as $record)
      <tr class="ns-record-container">
        <td class="text-right">
          <div class="presentation">
            {{ $record->subdomain }}
          </div>
          <div class="edit hidden">
            <input type="text" name="subdomain" value="{{ $record->subdomain }}" class="text-right" style="width: 100%;">
          </div>
        </td>
        <td class="text-center">
          {{ $record->type }}
          <input type="hidden" name="type" value="{{ $record->type }}">
        </td>
        <td>
          <div class="presentation">
            {{ str_limit($record->content, 35) }}
            @if ($record->type == 'CNAME' && $model->isIdn($record->content))
              <br><span class="text-muted">{{ idn_to_utf8($record->content) }}</span>
            @endif
            @if ($record->priority > 0)
              <br><span class="text-muted">priority</span>: {{ $record->priority }}
            @endif
            @if ($record->type == 'SRV')
              <br><span class="text-muted">port</span>: {{ $record->port }}
              <br><span class="text-muted">weight</span>: {{ $record->weight }}
            @endif
            @if ($record->type == 'SOA')
              <br><span class="text-muted">retry</span>: {{ $record->retry }}
              <br><span class="text-muted">refresh</span>: {{ $record->refresh }}
              <br><span class="text-muted">expire</span>: {{ $record->expire }}
              <br><span class="text-muted">ttl</span>: {{ $record->ttl }}
            @endif
          </div>
          <div class="edit hidden">
            <input class="w-100" type="text" name="content" value="{{ $record->content }}" {{ $record->type == 'SOA' ? 'readonly' : '' }}>
            @if ($record->priority > 0)
              <br><input class="w-100" type="text" name="priority" value="{{ $record->priority }}" placeholder="priority">
            @endif
            @if ($record->type == 'SRV')
              <br><input class="w-100" type="text" name="port" value="{{ $record->port }}" placeholder="port">
              <br><input class="w-100" type="text" name="weight" value="{{ $record->weight }}" placeholder="weight">
            @endif
            @if ($record->type == 'SOA')
              <br><input class="w-100" type="text" name="retry" value="{{ $record->retry }}" placeholder="retry">
              <br><input class="w-100" type="text" name="refresh" value="{{ $record->refresh }}" placeholder="refresh">
              <br><input class="w-100" type="text" name="expire" value="{{ $record->expire }}" placeholder="expire">
              <br><input class="w-100" type="text" name="ttl" value="{{ $record->ttl }}" placeholder="ttl">
            @endif
            <input type="hidden" name="record_id" value="{{ $record->record_id }}">
            {{ method_field('PUT') }}
          </div>
        </td>
        <td>
          <div class="presentation">
            <a class="pseudo js-ns-record-edit">настроить</a>
            &nbsp;
            <a class="pseudo js-ns-record-delete" data-id="{{ $record->record_id }}" data-action="{{ path("$self@deleteNsRecord", $model) }}">
              @svg (times)
            </a>
          </div>
          <div class="edit hidden">
            <a class="pseudo js-ns-record-save" data-action="{{ path("$self@editNsRecord", $model) }}">сохранить</a>
            &nbsp;
            <a class="pseudo js-ns-record-cancel">
              @svg (rotate-left)
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  </table>

  <form class="form-inline mt-3" action="{{ path("$self@setServerNsRecords", $model) }}" method="post">
    <p>
      <select class="form-control" name="server">
        <option value="">-----</option>
        <option>srv1.korden.net</option>
        <option>srv2.korden.net</option>
        <option>srv3.korden.net</option>
        <option>srv4.korden.net</option>
        <option value="bsd.korden.net">office.korden.net</option>
        <option>srv1.ivacuum.ru</option>
        <option>srv2.ivacuum.ru</option>
      </select>
      <button type="submit" class="btn btn-default">
        Прописать днс-записи сервера
      </button>
    </p>
    {{ csrf_field() }}
  </form>
@elseif ($model->yandex_user_id)
  <div class="alert alert-warning">
    ДНС-записи не найдены.
  </div>
@endif
@endsection
