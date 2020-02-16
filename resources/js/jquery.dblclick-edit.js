// Редактирование по двойному клику
$(document).on(
  'dblclick',
  '.js-dblclick-edit',
  (e) => { document.location = e.currentTarget.dataset.dblclickUrl },
)
