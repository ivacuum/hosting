// Выбрать все
$(document).on('click', '.js-select-all', function jsSelectAll() {
  $(this.dataset.selector).prop('checked', this.checked)

  if (this.dataset.triggerOnclick) {
    $(document).trigger(this.dataset.triggerOnclick)
  }
})
