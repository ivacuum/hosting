$(document).ajaxStart(function() {
  NProgress.start();
});

$(document).ajaxStop(function() {
  NProgress.done();
});

$.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

$(document).pjax('.js-pjax', '#pjax_container');

$(document).ready(function() {
  $('.tip').tooltip();

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

  // Прилипшие заголовки таблиц
  $('.js-float-thead').floatThead();

  // Выбрать все
  $(document).on('click', '.js-select-all', function() {
    var is_checked = $(this).prop('checked');
    var $selector = $($(this).data('selector'));
    $selector.prop('checked', is_checked);
  });

  // Операции над несколькими записями
  $('.js-batch-form').bind('submit', function(e) {
    e.preventDefault();
    
    var $form = $(this);
    var ids = $($form.data('selector') + ':checked').serialize();
    
    $.post($form.data('url'), $form.serialize() + '&' + ids, function(data) {
      if (data.redirect) {
        document.location = data.redirect;
      }
    });
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
    var url = $("#next_page").attr("href");
    
    if (typeof url !== "undefined") {
      document.location.href = url
    }
  });
  
  $(document).bind("shortcuts.to_prev_page", function() {
    var url = $("#previous_page").attr("href");
    
    if (typeof url !== "undefined") {
      document.location.href = url
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
});
