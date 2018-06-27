/* global App */

class YandexDns {
  static addRecord(e) {
    e.preventDefault()

    const $form = $(this).closest('.ns-record-container')

    axios.post($form.data('action'), $('input, select', $form).serialize()).then((response) => {
      if (response.data === 'ok') {
        $.pjax({
          url: document.location.href,
          container: App.pjax.container,
        })
      } else {
        alert(response.data)
      }
    })
  }

  static cancelEditing(e) {
    const $form = $(this).closest('.ns-record-container')

    $('.edit', $form).get().forEach((el) => { el.hidden = true })
    $('.presentation', $form).get().forEach((el) => { el.hidden = false })

    e.preventDefault()
  }

  static deleteRecord(e) {
    e.preventDefault()

    const id = $(this).data('id')

    if (confirm('Запись будет удалена. Продолжить?')) {
      axios.post($(this).data('action'), { record_id: id, _method: 'DELETE' }).then((response) => {
        if (response.data === 'ok') {
          $.pjax({
            url: document.location.href,
            container: App.pjax.container,
          })
        } else {
          alert(response.data)
        }
      })
    }
  }

  static editRecord(e) {
    e.preventDefault()

    const $form = $(this).closest('.ns-record-container')

    $('.edit', $form).get().forEach((el) => { el.hidden = false })
    $('.presentation', $form).get().forEach((el) => { el.hidden = true })
  }

  static saveRecord(e) {
    e.preventDefault()

    const $form = $(this).closest('.ns-record-container')

    axios.post($(this).data('action'), $('input', $form).serialize()).then((response) => {
      if (response.data === 'ok') {
        $.pjax({
          url: document.location.href,
          container: App.pjax.container,
        })
      } else {
        alert(response.data)
      }
    })
  }
}

$(document).on('click', '.js-ns-record-add', YandexDns.addRecord)
$(document).on('click', '.js-ns-record-edit', YandexDns.editRecord)
$(document).on('click', '.js-ns-record-delete', YandexDns.deleteRecord)
$(document).on('click', '.js-ns-record-save', YandexDns.saveRecord)
$(document).on('click', '.js-ns-record-cancel', YandexDns.cancelEditing)
