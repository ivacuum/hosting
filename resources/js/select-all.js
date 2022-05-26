// Выбрать все
document.addEventListener('click', (e) => {
  const target = e.target.closest('.js-select-all')

  if (target === null) {
    return
  }

  document.querySelectorAll(target.dataset.selector).forEach((el) => {
    el.checked = target.checked
  })
})
