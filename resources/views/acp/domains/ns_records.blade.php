@extends("$tpl.base")

@section('content')
{{--
@if ($model->domain_control and ($model->ns != 'dns1.yandex.net dns2.yandex.net' and $model->ns != 'dns1.yandex.ru dns2.yandex.ru'))
  <form action="{{ path("$self@setYandexNs", $model) }}" method="post">
    @csrf
    <p>
      <button class="btn btn-default">
        Установить DNS Яндекса
      </button>
    </p>
  </form>
@endif

@if (!$model->yandex_user_id)
  <form action="{{ path("$self@setYandexPdd", $model) }}" method="post">
    @csrf
    <p>
      <button class="btn btn-default">
        Подключить Яндекс.Почту для домена
      </button>
    </p>
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
      <td>
        <input class="form-control form-control-sm text-right" name="subdomain" value="@">
      </td>
      <td>
        <select class="custom-select custom-select-sm" name="type">
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
        <input class="form-control form-control-sm" name="content">
        <input class="form-control form-control-sm mt-1" name="priority" placeholder="priority [MX, SRV]">
        <input class="form-control form-control-sm mt-1" name="port" placeholder="port [SRV]">
        <input class="form-control form-control-sm mt-1" name="weight" placeholder="weight [SRV]">
      </td>
      <td>
        <a class="btn btn-default js-ns-record-add" href="#">добавить</a>
      </td>
    </tr>
    @foreach ($records as $record)
      <tr class="ns-record-container">
        <td>
          <div class="presentation text-right">
            {{ $record->subdomain }}
          </div>
          <div hidden class="edit">
            <input class="form-control form-control-sm text-right" name="subdomain" value="{{ $record->subdomain }}">
          </div>
        </td>
        <td class="text-center">
          {{ $record->type }}
          <input type="hidden" name="type" value="{{ $record->type }}">
        </td>
        <td>
          <div class="presentation">
            {{ Illuminate\Support\Str::limit($record->content, 35) }}
            @if ($record->type == 'CNAME' && $model->isIdn($record->content))
              <br><span class="text-muted">{{ idn_to_utf8($record->content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46) }}</span>
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
          <div hidden class="edit">
            <input class="form-control form-control-sm w-full" name="content" value="{{ $record->content }}" {{ $record->type == 'SOA' ? 'readonly' : '' }}>
            @if ($record->priority > 0)
              <input class="form-control form-control-sm mt-1 w-full" name="priority" value="{{ $record->priority }}" placeholder="priority">
            @endif
            @if ($record->type == 'SRV')
              <input class="form-control form-control-sm mt-1 w-full" name="port" value="{{ $record->port }}" placeholder="port">
              <input class="form-control form-control-sm mt-1 w-full" name="weight" value="{{ $record->weight }}" placeholder="weight">
            @endif
            @if ($record->type == 'SOA')
              <input class="form-control form-control-sm mt-1 w-full" name="retry" value="{{ $record->retry }}" placeholder="retry">
              <input class="form-control form-control-sm mt-1 w-full" name="refresh" value="{{ $record->refresh }}" placeholder="refresh">
              <input class="form-control form-control-sm mt-1 w-full" name="expire" value="{{ $record->expire }}" placeholder="expire">
              <input class="form-control form-control-sm mt-1 w-full" name="ttl" value="{{ $record->ttl }}" placeholder="ttl">
            @endif
            <input type="hidden" name="record_id" value="{{ $record->record_id }}">
            @method('put')
          </div>
        </td>
        <td>
          <div class="presentation">
            <a class="pseudo js-ns-record-edit mr-2" href="#">настроить</a>
            <a class="pseudo js-ns-record-delete" data-id="{{ $record->record_id }}" data-action="{{ path("$self@deleteNsRecord", $model) }}" href="#">
              @svg (times)
            </a>
          </div>
          <div hidden class="edit">
            <a class="pseudo js-ns-record-save mr-2" data-action="{{ path("$self@editNsRecord", $model) }}" href="#">сохранить</a>
            <a class="pseudo js-ns-record-cancel" href="#">
              @svg (rotate-left)
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  </table>

  <form class="flex flex-wrap mt-4" action="{{ path("$self@setServerNsRecords", $model) }}" method="post">
    @csrf
    <div class="mr-1">
      <select class="custom-select" name="server">
        <option value="">-----</option>
        <option>srv1.korden.net</option>
        <option>srv2.korden.net</option>
        <option>srv3.korden.net</option>
        <option>srv4.korden.net</option>
        <option value="bsd.korden.net">office.korden.net</option>
        <option>srv1.ivacuum.ru</option>
        <option>srv2.ivacuum.ru</option>
      </select>
    </div>
    <button class="btn btn-default">
      Прописать днс-записи сервера
    </button>
  </form>
@elseif ($model->yandex_user_id)
  <div class="alert alert-warning">
    ДНС-записи не найдены.
  </div>
@endif
@endsection
