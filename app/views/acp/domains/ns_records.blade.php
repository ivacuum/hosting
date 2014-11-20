@if (sizeof($records))
<div class="boxed-group flush">
  <h3>
    ДНС-записи
    <span class="label label-default">{{ sizeof($records) }}</span>
  </h3>
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
      <tr class="ns-record-container">
        <td class="text-right">
          <input type="text" name="subdomain" value="@" class="text-right">
        </td>
        <td class="text-center">
          <select name="type">
            <option value="a" selected>A</option>
            <option value="cname">CNAME</option>
            <option value="aaaa">AAAA</option>
            <option value="txt">TXT</option>
            <option value="ns">NS</option>
            <option value="mx">MX</option>
          </select>
        </td>
        <td><input type="text" name="content"></td>
        <td><a href="#" class="pseudo js-ns-record-add">добавить днс-запись</a></td>
      </tr>
      @foreach ($records as $record)
        <tr class="ns-record-container">
          <td class="text-right">
            <div class="presentation">
              {{ $record['subdomain'] }}
            </div>
            <div class="edit hidden">
              <input type="text" name="subdomain" value="{{{ $record['subdomain'] }}}" class="text-right">
            </div>
          </td>
          <td class="text-center">
            {{ $record['type'] }}
            <input type="hidden" name="type" value="{{{ strtolower($record['type']) }}}">
          </td>
          <td>
            <div class="presentation">
              @if ($record['priority'] > 0)
                <span class="text-muted">[{{ $record['priority'] }}]</span>
              @endif
              {{ str_limit($record, 35) }}
            </div>
            <div class="edit hidden">
              <input type="text" name="content" value="{{{ $record }}}">
              <input type="hidden" name="record_id" value="{{{ $record['id'] }}}">
              <input type="hidden" name="_method" value="PUT">
            </div>
          </td>
          <td>
            <div class="presentation">
              <a href="#" class="pseudo js-ns-record-edit">настроить</a>
              <a href="#" class="pseudo js-ns-record-delete" data-id="{{{ $record['id'] }}}">удалить</a>
            </div>
            <div class="edit hidden">
              <a href="#" class="pseudo js-ns-record-save">сохранить</a>
              <a href="#" class="pseudo js-ns-record-cancel">отменить</a>
            </div>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</div>

@else
  <div class="alert alert-warning">
    ДНС-записи не найдены.
  </div>
@endif

<script>
$(document).ready(function() {
  $('.js-ns-record-add').bind('click', function(e) {
    e.preventDefault();
    
    var form = $(this).closest('.ns-record-container');
    
    $.post('{{ action("$self@addNsRecord", [$domain->domain]) }}', $('input, select', form).serialize(), function(data) {
      if ('ok' === data) {
        $('.ns-records-container').each(function() {
          $(this).load($(this).data('deferred-url'));
        });
      } else {
        alert(data);
      }
    });
  });

  $('.js-ns-record-edit').bind('click', function(e) {
    e.preventDefault();
    
    var form = $(this).closest('.ns-record-container');
    
    $('.edit', form).removeClass('hidden');
    $('.presentation', form).addClass('hidden');
  });
  
  $('.js-ns-record-delete').bind('click', function(e) {
    e.preventDefault();
    
    var id = $(this).data('id');
    
    if (confirm('Запись будет удалена. Продолжить?')) {
      $.post('{{ action("$self@deleteNsRecord", [$domain->domain]) }}', { record_id: id, _method: 'DELETE' }, function(data) {
        if ('ok' === data) {
          $('.ns-records-container').each(function() {
            $(this).load($(this).data('deferred-url'));
          });
        } else {
          alert(data);
        }
      });
    }
  });
  
  $('.js-ns-record-save').bind('click', function(e) {
    e.preventDefault();
    
    var form = $(this).closest('.ns-record-container');
    
    $.post('{{ action("$self@editNsRecord", [$domain->domain]) }}', $('input', form).serialize(), function(data) {
      if ('ok' === data) {
        $('.ns-records-container').each(function() {
          $(this).load($(this).data('deferred-url'));
        });
      } else {
        alert(data);
      }
    });
  });
  
  $('.js-ns-record-cancel').bind('click', function(e) {
    e.preventDefault();
    
    var form = $(this).closest('.ns-record-container');
    
    $('.edit', form).addClass('hidden');
    $('.presentation', form).removeClass('hidden');
  })
});
</script>