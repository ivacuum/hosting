$(document).ajaxStart(function() {
  NProgress.start();
});

$(document).ajaxStop(function() {
  NProgress.done();
});

$.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

if ($.support.pjax) {
  $.pjax.defaults.timeout = 5000;
}

$(document).pjax('.js-pjax', '#pjax_container');

$(document).on('pjax:send', function(e) {
  $('#pjax_container').css('opacity', '.5');
});

$(document).on('pjax:complete', function() {
  $('#pjax_container').css('opacity', 1);
  $('.fotorama').fotorama();

  initOnLoadAndPjax();
});

// Форма поиска авиабилетов по клику
$(document).on('click', '.js-aviasales', function() {
  $(this).contents().unwrap();

  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.src = 'https://www.travelpayouts.com/widgets/044c854e39d539701be0fa773757da42.js?v=443';
  s.async = true;
  document.getElementById('aviasales_container').appendChild(s);
});

$(document).ready(function() {
  $(document).on('dblclick', '.js-dblclick-edit', function() {
    document.location = $(this).data('dblclick-url');
  });

  $('.js-deferred-load').each(function() {
    $(this).load($(this).data('deferred-url'));
  });

  $(document).on('click', '.js-confirm', function() {
    return confirm($(this).data('confirm'));
  });

  $(document).on('click', '.js-ajax', function(e) {
    e.preventDefault();

    $('.js-ajax').removeClass('active');
    $(this).addClass('active');

    var container = $(this).data('ajax-container') || '#ajax_container';
    var url = $(this).data('ajax-url') || $(this).attr('href');

    $(container).data('deferred-url', url);
    $(container).load(url);
  });

  // Проигрывание гифок по клику
  $(document).on('click', '.js-gif-click', function(e) {
    e.preventDefault();

    var $img = $('img', this);
    var src = $img.attr('src');
    var gif = $(this).attr('href');

    if (src != gif) {
      $img.data('static', src).attr('src', gif);
    } else {
      $img.attr('src', $img.data('static'));
    }
  });

  // Выбрать все
  $(document).on('click', '.js-select-all', function() {
    var is_checked = $(this).prop('checked');
    var $selector = $($(this).data('selector'));
    $selector.prop('checked', is_checked);
  });

  // Выбрать все
  $(document).on('click', '.js-select-all', function() {
    var is_checked = $(this).prop('checked');
    var $selector = $($(this).data('selector'));
    $selector.prop('checked', is_checked);
  });

  // Операции над несколькими записями
  $(document).on('submit', '.js-batch-form', function(e) {
    e.preventDefault();

    var $form = $(this);
    var ids = $($form.data('selector') + ':checked').serialize();

    $.post($form.data('url'), $form.serialize() + '&' + ids, function(data) {
      if (data.redirect) {
        document.location = data.redirect;
      }
    });
  });

  // Яндекс-днс
  $(document).on('click', '.js-ns-record-add', function(e) {
    var $form = $(this).closest('.ns-record-container');

    $.post($form.data('action'), $('input, select', $form).serialize(), function(data) {
      if ('ok' === data) {
        $.pjax({ url: document.location.href, container: '#pjax_container' });
      } else {
        alert(data);
      }
    });

    e.preventDefault();
  });

  $(document).on('click', '.js-ns-record-edit', function(e) {
    var $form = $(this).closest('.ns-record-container');

    $('.edit', $form).removeClass('hidden');
    $('.presentation', $form).addClass('hidden');

    e.preventDefault();
  });

  $(document).on('click', '.js-ns-record-delete', function(e) {
    var id = $(this).data('id');

    if (confirm('Запись будет удалена. Продолжить?')) {
      $.post($(this).data('action'), { record_id: id, _method: 'DELETE' }, function(data) {
        if ('ok' === data) {
          $.pjax({ url: document.location.href, container: '#pjax_container' });
        } else {
          alert(data);
        }
      });
    }

    e.preventDefault();
  });

  $(document).on('click', '.js-ns-record-save', function(e) {
    var $form = $(this).closest('.ns-record-container');

    $.post($(this).data('action'), $('input', $form).serialize(), function(data) {
      if ('ok' === data) {
        $.pjax({ url: document.location.href, container: '#pjax_container' });
      } else {
        alert(data);
      }
    });

    e.preventDefault();
  });

  $(document).on('click', '.js-ns-record-cancel', function(e) {
    var $form = $(this).closest('.ns-record-container');

    $('.edit', $form).addClass('hidden');
    $('.presentation', $form).removeClass('hidden');

    e.preventDefault();
  });

  // Горячие клавиши
  var shortcuts_enabled = true;

  $(document).on('focus', 'input,textarea,select', function() {
    shortcuts_enabled = false
  })

  $(document).on('blur', 'input,textarea,select', function() {
    shortcuts_enabled = true
  });

  if ($(".js-shortcuts-items").size()) {
    var shortcuts_items = $(".js-shortcuts-items .shortcuts-item");

    $(window).scroll(function() {
      var active_start_position = window.pageYOffset + 0;
      var active_end_position = window.pageYOffset + 50;

      shortcuts_items.each(function(index, item) {
        var shortcuts_item = $(item);
        var shortcuts_item_position = shortcuts_item.offset().top + 20;

        if (active_start_position < shortcuts_item_position && shortcuts_item_position < active_end_position) {
          if (shortcuts_item.hasClass("focus")) {} else {
            $(".js-shortcuts-items .shortcuts-item.focus").removeClass("focus");
            shortcuts_item.addClass("focus")
          }
        }
      })
    })
  }

  $(document).on('keyup', 'body', function(e) {
    var not_meta_key = !e.altKey && !e.ctrlKey && !e.metaKey;

    if (shortcuts_enabled) {
      if ((e.altKey || e.ctrlKey || e.metaKey) && e.which == 37) {
        e.preventDefault();
        $(document).trigger("shortcuts.to_prev_page")
      }
      if ((e.altKey || e.ctrlKey || e.metaKey) && e.which == 39) {
        e.preventDefault();
        $(document).trigger("shortcuts.to_next_page")
      }
    }
  });

  $("body").on('keypress', function(e) {
    var not_meta_key = !e.altKey && !e.ctrlKey && !e.metaKey;
    if (shortcuts_enabled) {
      // if ((e.which == 47 || e.which == 46) && not_meta_key) {
      //   e.preventDefault();
      //   $(document).trigger("shortcuts.focus_to_search")
      // }
      if ((e.which == 104 || e.which == 1088) && not_meta_key) {
        e.preventDefault();
        $(document).trigger("shortcuts.to_first_post")
      }
      if ((e.which == 108 || e.which == 1076) && not_meta_key) {
        e.preventDefault();
        $(document).trigger("shortcuts.to_last_post")
      }
      if ((e.which == 106 || e.which == 1086) && not_meta_key) {
        e.preventDefault();
        $(document).trigger("shortcuts.to_next_post")
      }
      if ((e.which == 107 || e.which == 1083) && not_meta_key) {
        e.preventDefault();
        $(document).trigger("shortcuts.to_prev_post")
      }
    }
  });

  // $(document).bind("shortcuts.focus_to_search", function(event, form) {
  //   $(".nav_panel .tab_menu").click();
  //   $('.global_search_form input[name="q"]').focus()
  // });

  $(document).bind("shortcuts.to_next_page", function() {
    var $link = $('#next_page')
    var url = $link.attr("href")

    if (typeof url !== "undefined") {
      if ($link.hasClass('js-pjax')) {
        $.pjax({ url: url, container: '#pjax_container' })
      } else {
        document.location.href = url
      }
    }
  });

  $(document).bind("shortcuts.to_prev_page", function() {
    var $link = $('#previous_page');
    var url = $link.attr("href")

    if (typeof url !== "undefined") {
      if ($link.hasClass('js-pjax')) {
        $.pjax({ url: url, container: '#pjax_container' })
      } else {
        document.location.href = url
      }
    }
  });

  $(document).bind("shortcuts.to_first_post", function() {
    var shortcuts_items = $(".js-shortcuts-items");

    if (shortcuts_items.size()) {
      if ($(".shortcuts-item", shortcuts_items).first().hasClass("focus")) {
        $(document).trigger("shortcuts.to_prev_page")
      } else {
        $(".shortcuts-item.focus", shortcuts_items).removeClass("focus");
        $(".shortcuts-item", shortcuts_items).first().addClass("focus")
      }

      $.scrollTo($(".shortcuts-item.focus", shortcuts_items), 200, {
        axis: "y"
      })
    }
  });

  $(document).bind("shortcuts.to_last_post", function() {
    var shortcuts_items = $(".js-shortcuts-items");

    if (shortcuts_items.size()) {
      if ($(".shortcuts-item", shortcuts_items).last().hasClass("focus")) {
        $(document).trigger("shortcuts.to_next_page")
      } else {
        $(".shortcuts-item.focus", shortcuts_items).removeClass("focus");
        $(".shortcuts-item", shortcuts_items).last().addClass("focus")
      }

      $.scrollTo($(".shortcuts-item.focus", shortcuts_items), 200, {
        axis: "y"
      })
    }
  });

  $(document).bind("shortcuts.to_next_post", function() {
    var shortcuts_items = $(".js-shortcuts-items");

    if (shortcuts_items.size()) {
      if ($(".shortcuts-item.focus", shortcuts_items).size() == 0) {
        $(".shortcuts-item", shortcuts_items).first().addClass("focus")
      } else {
        var shortcuts_item = $(".shortcuts-item.focus", shortcuts_items);
        var next_shortcuts_item = shortcuts_item.next();

        if (next_shortcuts_item.size() == 0) {
          $(document).trigger("shortcuts.to_next_page")
        } else {
          shortcuts_item.removeClass("focus");
          next_shortcuts_item.addClass("focus")
        }
      }

      $.scrollTo($(".shortcuts-item.focus", shortcuts_items), 200, {
        axis: "y"
      })
    }
  });

  $(document).bind("shortcuts.to_prev_post", function() {
    var shortcuts_items = $(".js-shortcuts-items");

    if (shortcuts_items.size()) {
      if ($(".shortcuts-item.focus", shortcuts_items).size() == 0) {
        $(".shortcuts-item", shortcuts_items).last().addClass("focus")
      } else {
        var shortcuts_item = $(".shortcuts-item.focus", shortcuts_items);
        var prev_shortcuts_item = shortcuts_item.prev();

        if (prev_shortcuts_item.size() == 0) {
          $(document).trigger("shortcuts.to_prev_page")
        } else {
          shortcuts_item.removeClass("focus");
          prev_shortcuts_item.addClass("focus")
        }
      }

      $.scrollTo($(".shortcuts-item.focus", shortcuts_items), 200, {
        axis: "y"
      })
    }
  });

  initOnLoadAndPjax();
});

function initOnLoadAndPjax() {
  // Прилипшие заголовки таблиц
  $('.js-float-thead').floatThead();

  // Подсказки
  $('.tip').tooltip();
}
