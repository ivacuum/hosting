// Операции над несколькими записями
$(document).on('submit', '.js-batch-form', function jsBatchForm(e) {
  e.preventDefault()

  const { selector, url } = e.currentTarget.dataset
  const formData = new FormData(this)

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
