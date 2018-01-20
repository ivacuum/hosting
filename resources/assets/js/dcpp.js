// Показ клиентов DC++ для всех платформ
$(document).on('click', '.js-dcpp-clients-show', function (e) {
  e.preventDefault()

  document.querySelectorAll(this.dataset.target).forEach(el => el.hidden = false)

  this.hidden = true
})

// Учет кликов по хабам
$(document).on('click', '.js-dcpp-hub', function () {
  const clicked = this.dataset.clicked

  if (clicked === undefined) {
    axios.post(this.dataset.action)

    this.dataset.clicked = 1
  }
})
