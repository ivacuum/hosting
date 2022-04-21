export default class YandexDns {
  static bind() {
    this.cancelEditing()
    this.editRecord()
    this.deleteRecord()
    this.saveRecord()
  }

  static cancelEditing() {
    $(document).on('click', '.js-ns-record-cancel', function cancelEditingHandler(e) {
      e.preventDefault()

      const form = this.closest('.ns-record-container')

      form.querySelectorAll('.edit').forEach((el) => {
        el.hidden = true
      })
      form.querySelectorAll('.presentation').forEach((el) => {
        el.hidden = false
      })
    })
  }

  static deleteRecord() {
    $(document).on('click', '.js-ns-record-delete', function deleteRecordHandler(e) {
      e.preventDefault()

      const {id} = this.dataset

      notie.confirm({
        text: 'Запись будет удалена. Продолжить?',
        submitText: 'Да',
        cancelText: 'Отмена',
        submitCallback: () => {
          axios
            .post($(this).data('action'), {record_id: id, _method: 'DELETE'})
            .then((response) => {
              if (response.data === 'ok') {
                document.location.reload()
              } else {
                notie.alert({text: response.data})
              }
            })
        },
      })
    })
  }

  static editRecord(selector = '.js-ns-record-edit') {
    $(document).on('click', selector, function editRecordHandler(e) {
      e.preventDefault()

      const form = this.closest('.ns-record-container')

      form.querySelectorAll('.edit').forEach((el) => {
        el.hidden = false
      })
      form.querySelectorAll('.presentation').forEach((el) => {
        el.hidden = true
      })
    })
  }

  static saveRecord() {
    $(document).on('click', '.js-ns-record-save', function saveRecordHandler(e) {
      e.preventDefault()

      const $form = $(this).closest('.ns-record-container')

      axios
        .post($(this).data('action'), $('input', $form).serialize())
        .then((response) => {
          if (response.data === 'ok') {
            document.location.reload()
          } else {
            notie.alert({text: response.data})
          }
        })
    })
  }
}
