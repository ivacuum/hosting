// Действие над сущностью
document.addEventListener('click', (e) => {
  const target = e.target.closest('.js-entity-action')

  if (target === null) {
    return
  }

  e.preventDefault()

  const confirmText = target.dataset.confirm

  if (target.classList.contains('disabled')) {
    return false
  }

  if (confirmText) {
    if (!confirm(confirmText)) {
      return false
    }
  }

  target.classList.add('disabled')

  fetch(target.getAttribute('href'), {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
      'X-Requested-With': 'XMLHttpRequest',
    },
  })
    .then(response => response.json())
    .then(json => {
      if (json.status === 'OK') {
        document.location.href = json.redirect
      } else {
        alert(json.message || 'Something went wrong')
      }
    })

  return true
})
