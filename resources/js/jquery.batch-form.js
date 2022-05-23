// Операции над несколькими записями
document.addEventListener('submit', (e) => {
  const target = e.target.closest('.js-batch-form')

  if (target === null) {
    return
  }

  e.preventDefault()

  const { selector, url } = target.dataset
  const formData = new FormData(target)

  document.querySelectorAll(`${selector}:checked`).forEach((el) => {
    formData.append('ids[]', el.value)
  })

  fetch(url, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
    },
    body: formData
  })
    .then(() => document.location.reload())
})
