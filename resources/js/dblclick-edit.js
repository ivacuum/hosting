// Редактирование по двойному клику
document.addEventListener('dblclick', (e) => {
  const target = e.target.closest('.js-dblclick-edit')

  if (target) {
    document.location = target.dataset.dblclickUrl
  }
})
