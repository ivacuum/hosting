// Операции над несколькими записями
$(document).on('submit', '.js-batch-form', function jsBatchForm(e) {
  e.preventDefault()

  const { selector, url } = e.currentTarget.dataset
  const $form = $(this)
  const ids = $(`${selector}:checked`).serialize()

  axios
    .post(url, `${$form.serialize()}&${ids}`)
    .then(({ data }) => {
      if (data.redirect) {
        document.location = data.redirect
      }
    })
})
