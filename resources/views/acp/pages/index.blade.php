@extends('acp.base')

@section('content')
  <div class="d-flex align-items-center flex-wrap mb-2 mt-n2">
  <h3 class="tw-mb-1 mr-3">{{ trans("$tpl.index") }}</h3>
  @include('acp.tpl.create-button')
</div>
<table id="tree" class="table-stats">
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
      <td></td>
    </tr>
  </tbody>
</table>

<form class="form-inline mt-3">
  <div class="mr-1">
    <select class="custom-select" name="action" id="batch_action">
      <option value="">Выберите действие...</option>
      <option value="activate">Включить</option>
      <option value="deactivate">Выключить</option>
      <option value="delete">Удалить</option>
    </select>
  </div>
  <button class="btn btn-default" id="batch_submit">Выполнить</button>
</form>

<span hidden id="page_active_icon">
  <span class="text-success" title="Отображается">
    @svg (eye)
  </span>
</span>

<span hidden id="page_edit_icon">
  @svg (pencil)
</span>
@endsection

@push('js')
<script type="module">
let selectedPages;

$('#batch_submit').bind('click', function (e) {
  e.preventDefault();

  $.post('/acp/pages/batch', { action: $('#batch_action').val(), pages: selectedPages }, function (data) {
    document.location = '/acp/pages';
  });
});

let page_active_icon = $('#page_active_icon').html();
let page_edit_icon = $('#page_edit_icon').html();

$('#tree').fancytree({
  icons: false,
  checkbox: true,
  source: { url: '/acp/pages/tree' },

  extensions: ['dnd', 'table'],

  // click: function (e, data) {
  //   console.log(e, data, data.targetType);
  // },

  dblclick: function (e, data) {
    document.location = data.node.data.edit_url;
    return true;
  },

  select: function (e, data) {
    selectedPages = $.map(data.tree.getSelectedNodes(), function (node) {
      return node.key;
    });

    return true;
  },

  dnd: {
    preventVoidMoves: true,
    preventRecursiveMoves: true,
    autoExpandMS: 400,
    dragStart: function (node, data) {
      return true;
    },
    dragEnter: function (node, data) {
      // return ["before", "after"];
      return true;
    },
    dragDrop: function (node, data) {
      data.otherNode.moveTo(node, data.hitMode);

      $.post('/acp/pages/move', {
        what: data.otherNode.key,
        how: data.hitMode,
        where: node.key
      }, function (response) {
        if ('ok' === response) {
          // var tree = $("div:ui-fancytree").data("ui-fancytree").getTree();
          // console.log(data);
          data.tree.reload().done(function () {
            // console.log('reloaded');
          });
          // $('#ajax_container').each(function () {
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

  renderColumns: function (e, data) {
    let node = data.node,
      $tds = $(node.tr).find('>td');

    if (node.data.activated == 1) {
      $tds.eq(2).html(page_active_icon)
    } else {
      $tds.eq(2).html('')
    }

    $tds.eq(3).html('<a href="' + node.data.url + '">' + node.data.url + '</a>');
    $tds.eq(4).text(node.data.handler);

    if (node.data.redirect) {
      $tds.eq(3).append('<br><span class="text-muted">&rarr; ' + node.data.redirect + '</span>');
    }

    $tds.eq(5).html('<a href="' + node.data.edit_url + '">' + page_edit_icon + '</a>');
  }
});
</script>
@endpush
