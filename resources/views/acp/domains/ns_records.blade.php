@extends('acp.domains.base')

@section('content')
{{--
@if ($domain->domain_control and ($domain->ns != 'dns1.yandex.net dns2.yandex.net' and $domain->ns != 'dns1.yandex.ru dns2.yandex.ru'))
  <form action="{{ action("$self@setYandexNs", $domain) }}" method="post">
    <p>
      <button type="submit" class="btn btn-default">
        Установить DNS Яндекса
      </button>
    </p>
		{{ csrf_field() }}
  </form>
@endif

@if (!$domain->yandex_user_id)
  <form action="{{ action("$self@setYandexPdd", $domain) }}" method="post">
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
<div class="boxed-group flush">
  <div class="boxed-group-inner">
    <table class="table-stats">
      <thead>
        <tr>
          <th>Хост</th>
          <th style="text-align: center;">Тип</th>
          <th>Значение записи</th>
          <th></th>
        </tr>
      </thead>
      <tr class="ns-record-container" data-action="{{ action("$self@addNsRecord", $domain) }}">
        <td class="text-right">
          <input type="text" name="subdomain" value="@" class="text-right" style="width: 100%;">
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
          <input type="text" name="content" style="width: 100%;">
          <br><input type="text" name="priority" style="width: 100%;" placeholder="priority [MX, SRV]">
          <br><input type="text" name="port" style="width: 100%;" placeholder="port [SRV]">
          <br><input type="text" name="weight" style="width: 100%;" placeholder="weight [SRV]">
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
              @if ($record->type == 'CNAME' && $domain->isIdn($record->content))
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
              <input type="text" name="content" value="{{ $record->content }}" style="width: 100%;" {{ $record->type == 'SOA' ? 'readonly' : '' }}>
              @if ($record->priority > 0)
                <br><input type="text" name="priority" value="{{ $record->priority }}" style="width: 100%;" placeholder="priority">
              @endif
              @if ($record->type == 'SRV')
                <br><input type="text" name="port" value="{{ $record->port }}" style="width: 100%;" placeholder="port">
                <br><input type="text" name="weight" value="{{ $record->weight }}" style="width: 100%;" placeholder="weight">
              @endif
              @if ($record->type == 'SOA')
                <br><input type="text" name="retry" value="{{ $record->retry }}" style="width: 100%;" placeholder="retry">
                <br><input type="text" name="refresh" value="{{ $record->refresh }}" style="width: 100%;" placeholder="refresh">
                <br><input type="text" name="expire" value="{{ $record->expire }}" style="width: 100%;" placeholder="expire">
                <br><input type="text" name="ttl" value="{{ $record->ttl }}" style="width: 100%;" placeholder="ttl">
              @endif
              <input type="hidden" name="record_id" value="{{ $record->record_id }}">
              {{ method_field('PUT') }}
            </div>
          </td>
          <td>
            <div class="presentation">
              <a class="pseudo js-ns-record-edit">настроить</a>
              &nbsp;
              <a class="pseudo js-ns-record-delete" data-id="{{ $record->record_id }}" data-action="{{ action("$self@deleteNsRecord", $domain) }}">
                @php (require base_path('resources/svg/times.html'))
              </a>
            </div>
            <div class="edit hidden">
              <a class="pseudo js-ns-record-save" data-action="{{ action("$self@editNsRecord", $domain) }}">сохранить</a>
              &nbsp;
              <a class="pseudo js-ns-record-cancel">
                @php (require base_path('resources/svg/rotate-left.html'))
              </a>
            </div>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</div>

<form class="form-inline" action="{{ action("$self@setServerNsRecords", $domain) }}" method="post">
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
@elseif ($domain->yandex_user_id)
  <div class="alert alert-warning">
    ДНС-записи не найдены.
  </div>
@endif
@endsection
