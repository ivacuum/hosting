// Действие над сущностью
$(document).on('click', '.js-entity-action', function jsEntityAction(e) {
  e.preventDefault()

  const $this = $(this)
  const confirmText = this.dataset.confirm

  if ($this.hasClass('disabled')) {
    return false
  }

  if (confirmText) {
    if (!confirm(confirmText)) {
      return false
    }
  }

  const method = this.dataset.method || 'post'

  $this.addClass('disabled')

  $.ajax({
    url: $this.attr('href'),
    method: method.toLowerCase() === 'get' ? 'get' : 'post',
    data: { _method: method.toUpperCase() },
  })
    .done((data) => {
      if (data.status === 'OK') {
        $.pjax({
          url: data.redirect,
          container: App.pjax.container,
        })
      } else {
        // App.addFlashNotification(data.message || 'Что-то пошло не так', 'danger')
        alert(data.message || 'Что-то пошло не так')
      }
    })
    .fail((jqxhr) => {
      // App.addFlashNotification(`${jqxhr.status} ${jqxhr.statusText}`, 'danger')
      alert(`${jqxhr.status} ${jqxhr.statusText}`)
    })

  return true
})
