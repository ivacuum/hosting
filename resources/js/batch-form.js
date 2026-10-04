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
    body: formData
  })
    .then(() => document.location.reload())
})
