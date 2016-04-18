@extends('acp.base', [
  'meta_title' => 'Страницы'
])

@section('content')
<div class="boxed-group flush">
  @include('acp.tpl.create')
  <h3>Страницы</h3>
  <div class="boxed-group-inner">
    <table id="tree" class="table-stats">
      <colgroup>
        <col width="20">
        <col width="*">
        <col width="30">
        <col width="200">
        <col width="250">
        <col width="50">
      </colgroup>
      <thead>
        <tr>
          <th></th>
          <th>Страница</th>
          <th></th>
          <th>Адрес</th>
          <th>Обработчик</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<form class="form-inline">
  <div class="form-group">
    <select class="form-control" name="action" id="batch_action">
      <option value="">Выберите действие...</option>
      <option value="activate">Включить</option>
      <option value="deactivate">Выключить</option>
      <option value="delete">Удалить</option>
    </select>
  </div>
  <button class="btn btn-default" id="batch_submit">Выполнить</button>
</form>

<span id="page_active_icon" class="hidden">
  <span class="text-success" title="Отображается">
    @include('tpl.svg.eye')
  </span>
</span>

<span id="page_edit_icon" class="hidden">
  @include('tpl.svg.pencil')
</span>
@endsection

@push('js')
<script>
$(function() {
  var selectedPages;

  $('#batch_submit').bind('click', function(e) {
    e.preventDefault();

    $.post('/acp/pages/batch', { action: $('#batch_action').val(), pages: selectedPages }, function(data) {
      document.location = '/acp/pages';
    });
  });

  var page_active_icon = $('#page_active_icon').html();
  var page_edit_icon = $('#page_edit_icon').html();

  $('#tree').fancytree({
    icons: false,
    checkbox: true,
    source: { url: '/acp/pages/tree' },

    extensions: ['dnd', 'table'],

    // click: function(e, data) {
    //   console.log(e, data, data.targetType);
    // },

    dblclick: function(e, data) {
      document.location = data.node.data.edit_url;
      return true;
    },

    select: function(e, data) {
      selectedPages = $.map(data.tree.getSelectedNodes(), function(node) {
        return node.key;
      });

      return true;
    },

    dnd: {
      preventVoidMoves: true,
      preventRecursiveMoves: true,
      autoExpandMS: 400,
      dragStart: function(node, data) {
        return true;
      },
      dragEnter: function(node, data) {
        // return ["before", "after"];
        return true;
      },
      dragDrop: function(node, data) {
        data.otherNode.moveTo(node, data.hitMode);

        $.post('/acp/pages/move', {
          what: data.otherNode.key,
          how: data.hitMode,
          where: node.key
        }, function(response) {
          if ('ok' === response) {
            // var tree = $("div:ui-fancytree").data("ui-fancytree").getTree();
            // console.log(data);
            data.tree.reload().done(function() {
              // console.log('reloaded');
            });
            // $('#ajax_container').each(function() {
            //   $(this).load($(this).data('deferred-url'));
            // });
          } else {
            alert(response);
          }
        });
      }
    },

    table: {
      indentation: 20,
      nodeColumnIdx: 1,
      checkboxColumnIdx: 0,
    },

    renderColumns: function(e, data) {
      var node = data.node,
        $tds = $(node.tr).find('>td');

      if (node.data.activated == 1) {
        $tds.eq(2).html(page_active_icon)
      } else {
        $tds.eq(2).html('')
      }

      $tds.eq(3).html('<a class="link" href="' + node.data.url + '">' + node.data.url + '</a>');
      $tds.eq(4).text(node.data.handler);

      if (node.data.redirect) {
        $tds.eq(3).append('<br><span class="text-muted">&rarr; ' + node.data.redirect + '</span>');
      }

      $tds.eq(5).html('<a class="link" href="' + node.data.edit_url + '">' + page_edit_icon + '</a>');
    }
  });
});
</script>
@endpush
