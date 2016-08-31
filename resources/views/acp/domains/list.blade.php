@if (sizeof($models))
<h3>
  <form class="form-inline">
    {{ $models->total() }} {{ trans_choice('plural.domains', $models->total()) }}
    @include('acp.tpl.create')
    <input type="search" name="q" class="form-control" placeholder="Поиск..." value="{{ $q or '' }}">
    <input type="hidden" name="filter" value="{{ $filter or '' }}">
  </form>
</h3>
@if (sizeof($models))
  <table class="table-stats js-float-thead m-b-1">
    <colgroup>
      <col width="30">
      <col width="*">
      <col width="110">
      <col width="150">
      <col width="150">
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
    @foreach ($models as $i => $model)
      <tr class="js-dblclick-edit" data-dblclick-url="/acp/domains/{{ $model->domain }}/edit?goto={{ $back_url }}">
        <td>
          <input class="domains-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}">
        </td>
        <td>
          <a href="http://{{ $model->domain }}/" target="_blank" style="margin-right: 0.3em;">
            @php (require base_path('resources/svg/external-link.html'))
          </a>
          <a href="/acp/domains/{{ $model->domain }}" class="link">{{ $model->domain }}</a>
          @if ($model->alias_id)
            <span class="text-muted">
              алиас
              <a href="/acp/domains/{{ $model->alias->domain }}" class="link">{{ $model->alias->domain }}</a>
            </span>
          @endif
          @if ($model->text)
            <span class="label label-default tip" title="есть заметки">...</span>
          @endif
          @if (!$model->domain_control)
            <span class="label label-info tip" title="не в нашей панели">?</span>
          @endif
          @if ($model->domain_control and $model->isExpired())
            <span class="label label-danger tip" title="просрочена оплата">$</span>
          @endif
          @if ($model->domain_control and $model->isExpiringSoon())
            <span class="label label-warning tip" title="подходит срок оплаты">$</span>
          @endif
        </td>
        <td class="text-muted">
          <span class="tip" title="{{ $model->paid_till }}">
            {{ $model->paid_till->toDateString() }}
          </span>
        </td>
        <td>{!! $model->whatServerIpv4() !!}</td>
        <td>{{ $model->firstNsServer() }}</td>
        <td>
          @if (!$model->isExpired() && ($model->cms_url || ($model->alias_id and $model->alias->cms_url)))
            @include('acp.domains.cms_login', ['cms_button_class' => 'btn btn-default btn-xs'])
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

<div class="pull-left m-b-1">
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
  @include('tpl.paginator', ['paginator' => $models])
</div>

<div class="clearfix"></div>

<p>
  <span class="label label-default">...</span> &nbsp;есть заметки &nbsp;
  <span class="label label-info">?</span> &nbsp;не в нашей панели &nbsp;
  <span class="label label-danger">$</span> &nbsp;просрочена оплата &nbsp;
  <span class="label label-warning">$</span> &nbsp;подходит срок оплаты
</p>
@else
  <div class="alert alert-warning">
    По заданному критерию не найдено ни одного домена.
  </div>
@endif
