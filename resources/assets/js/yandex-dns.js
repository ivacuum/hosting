/* global App */

export default class YandexDns {
  static bind() {
    this.addRecord()
    this.cancelEditing()
    this.editRecord()
    this.deleteRecord()
    this.saveRecord()
  }

  static addRecord() {
    $(document).on('click', '.js-ns-record-add', function addRecordHandler(e) {
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
    })
  }

  static cancelEditing() {
    $(document).on('click', '.js-ns-record-cancel', function cancelEditingHandler(e) {
      e.preventDefault()

      const form = this.closest('.ns-record-container')

      form.querySelectorAll('.edit').forEach((el) => { el.hidden = true })
      form.querySelectorAll('.presentation').forEach((el) => { el.hidden = false })
    })
  }

  static deleteRecord() {
    $(document).on('click', '.js-ns-record-delete', function deleteRecordHandler(e) {
      e.preventDefault()

      const { id } = this.dataset

      if (confirm('Запись будет удалена. Продолжить?')) {
        axios.post($(this).data('action'), { record_id: id, _method: 'DELETE' })
          .then((response) => {
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
    })
  }

  static editRecord(selector = '.js-ns-record-edit') {
    $(document).on('click', selector, function editRecordHandler(e) {
      e.preventDefault()

      const form = this.closest('.ns-record-container')

      form.querySelectorAll('.edit').forEach((el) => { el.hidden = false })
      form.querySelectorAll('.presentation').forEach((el) => { el.hidden = true })
    })
  }

  static saveRecord() {
    $(document).on('click', '.js-ns-record-save', function saveRecordHandler(e) {
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
    })
  }
}
