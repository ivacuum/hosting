class YandexDns {
  static addRecord(e) {
    let $form = $(this).closest('.ns-record-container')

    $.post($form.data('action'), $('input, select', $form).serialize(), data => {
      if ('ok' === data) {
        $.pjax({
          url: document.location.href,
          container: App.pjax.container
        })
      } else {
        alert(data)
      }
    })

    e.preventDefault()
  }

  static cancelEditing(e) {
    let $form = $(this).closest('.ns-record-container')

    $('.edit', $form).get().forEach(el => el.hidden = true)
    $('.presentation', $form).get().forEach(el => el.hidden = false)

    e.preventDefault()
  }

  static deleteRecord(e) {
    let id = $(this).data('id')

    if (confirm('Запись будет удалена. Продолжить?')) {
      $.post($(this).data('action'), { record_id: id, _method: 'DELETE' }, data => {
        if ('ok' === data) {
          $.pjax({
            url: document.location.href,
            container: App.pjax.container
          })
        } else {
          alert(data)
        }
      })
    }

    e.preventDefault()
  }

  static editRecord(e) {
    let $form = $(this).closest('.ns-record-container')

    $('.edit', $form).get().forEach(el => el.hidden = false)
    $('.presentation', $form).get().forEach(el => el.hidden = true)

    e.preventDefault()
  }

  static saveRecord(e) {
    let $form = $(this).closest('.ns-record-container')

    $.post($(this).data('action'), $('input', $form).serialize(), data => {
      if ('ok' === data) {
        $.pjax({
          url: document.location.href,
          container: App.pjax.container
        })
      } else {
        alert(data)
      }
    })

    e.preventDefault()
  }
}

$(document).on('click', '.js-ns-record-add', YandexDns.addRecord)
$(document).on('click', '.js-ns-record-edit', YandexDns.editRecord)
$(document).on('click', '.js-ns-record-delete', YandexDns.deleteRecord)
$(document).on('click', '.js-ns-record-save', YandexDns.saveRecord)
$(document).on('click', '.js-ns-record-cancel', YandexDns.cancelEditing)
