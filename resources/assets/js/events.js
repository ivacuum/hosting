class Events {
  // Форма поиска авиабилетов по клику
  static aviasales() {
    $(this).contents().unwrap();

    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.src = 'https://www.travelpayouts.com/widgets/044c854e39d539701be0fa773757da42.js?v=443';
    s.async = true;
    document.getElementById('aviasales_container').appendChild(s);
  }

  // Операции над несколькими записями
  static batchForm(e) {
    e.preventDefault();

    let $form = $(this);
    let ids = $($form.data('selector') + ':checked').serialize();

    $.post($form.data('url'), $form.serialize() + '&' + ids, (data) => {
      if (data.redirect) {
        document.location = data.redirect;
      }
    });
  }

  static gifClick(e) {
    e.preventDefault();

    let $img = $('img', this);
    let src = $img.attr('src');
    let gif = $(this).attr('href');

    if (src != gif) {
      $img.data('static', src).attr('src', gif);
    } else {
      $img.attr('src', $img.data('static'));
    }
  }
}

$(document).on('click', '.js-aviasales', Events.aviasales);
$(document).on('submit', '.js-batch-form', Events.batchForm);

// Подтверждение действия
$(document).on('click', '.js-confirm', () => confirm($(this).data('confirm')));

// Проигрывание гифок по клику
$(document).on('click', '.js-gif-click', Events.gifClick);

// Редактирование по двойному клику
$(document).on('dblclick', '.js-dblclick-edit', () => document.location = $(this).data('dblclick-url'));

// Выбрать все
$(document).on('click', '.js-select-all', function() {
  let is_checked = $(this).prop('checked');
  let $selector = $($(this).data('selector'));
  $selector.prop('checked', is_checked);
});
