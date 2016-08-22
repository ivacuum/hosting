@if (sizeof($domains))
<h3>
  <form class="form-inline">
    {{ $domains->total() }} {{ trans_choice('plural.domains', $domains->total()) }}
    &nbsp;
    <input type="search" name="q" class="form-control" placeholder="Поиск..." value="{{ $q or '' }}">
    <input type="hidden" name="filter" value="{{ $filter or '' }}">
    <a href="{{ action('Acp\Domains@create') }}" class="btn btn-success">
      @php (require base_path('resources/svg/plus.html'))
    </a>
  </form>
</h3>
@if (sizeof($domains))
  <table class="table-stats js-float-thead m-b-1">
    <colgroup>
      <col width="30">
      <col width="*">
      <col width="125">
      <col width="200">
      <col width="200">
      <col width="60">
    </colgroup>
    <thead>
      <tr>
        <th><input type="checkbox" class="js-select-all" data-selector=".domains-checkbox"></th>
        <th>Домен</th>
        <th>Оплачен до</th>
        <th>Сервер</th>
        <th>NS</th>
        <th>CMS</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($domains as $i => $domain)
      <tr class="js-dblclick-edit" data-dblclick-url="/acp/domains/{{ $domain->domain }}/edit?goto={{ $back_url }}">
        <td>
          <input class="domains-checkbox" type="checkbox" name="ids[]" value="{{ $domain->id }}">
        </td>
        <td>
          <a href="http://{{ $domain->domain }}/" target="_blank" style="margin-right: 0.3em;">
            @php (require base_path('resources/svg/external-link.html'))
          </a>
          <a href="/acp/domains/{{ $domain->domain }}" class="link">{{ $domain->domain }}</a>
          @if ($domain->alias_id)
            <span class="text-muted">
              алиас
              <a href="/acp/domains/{{ $domain->alias->domain }}" class="link">{{ $domain->alias->domain }}</a>
            </span>
          @endif
          @if ($domain->text)
            <span class="label label-default tip" title="есть заметки">...</span>
          @endif
          @if (!$domain->domain_control)
            <span class="label label-info tip" title="не в нашей панели">?</span>
          @endif
          @if ($domain->domain_control and $domain->isExpired())
            <span class="label label-danger tip" title="просрочена оплата">$</span>
          @endif
          @if ($domain->domain_control and $domain->isExpiringSoon())
            <span class="label label-warning tip" title="подходит срок оплаты">$</span>
          @endif
        </td>
        <td class="text-muted">
          <span class="tip" title="{{ $domain->paid_till }}">
            {{ $domain->paid_till->toDateString() }}
          </span>
        </td>
        <td>{!! $domain->whatServerIpv4() !!}</td>
        <td>{{ $domain->firstNsServer() }}</td>
        <td>
          @if (!$domain->isExpired() && ($domain->cms_url || ($domain->alias_id and $domain->alias->cms_url)))
            @include('acp.domains.cms_login', ['cms_button_class' => 'btn btn-default btn-xs'])
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

<div class="pull-left" style="margin: 0 0 1em;">
  <form class="form-inline js-batch-form" data-url="/acp/domains/batch" data-selector=".domains-checkbox">
    <div class="form-group">
      <select class="form-control" name="action" id="batch_action">
        <option value="">Выберите действие...</option>
        @if ($filter == 'trashed')
          <option value="restore">Восстановить</option>
          <option value="force_delete">Удалить окончательно</option>
        @else
          <option value="activate">Включить мониторинг</option>
          <option value="deactivate">Выключить мониторинг</option>
          <option value="delete">Удалить</option>
        @endif
      </select>
    </div>
    <button class="btn btn-default" id="batch_submit">Выполнить</button>
  </form>
</div>

<div class="pull-right">
  @include('tpl.paginator', ['paginator' => $domains])
</div>

<div class="clearfix"></div>

<p>
  <span class="label label-default">...</span> &nbsp;— есть заметки &nbsp;
  <span class="label label-info">?</span> &nbsp;— не в нашей панели &nbsp;
  <span class="label label-danger">$</span> &nbsp;— просрочена оплата &nbsp;
  <span class="label label-warning">$</span> &nbsp;— подходит срок оплаты
</p>
@else
  <div class="alert alert-warning">
    По заданному критерию не найдено ни одного домена.
  </div>
@endif
