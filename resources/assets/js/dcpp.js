// Показ клиентов DC++ для всех платформ
$(document).on('click', '.js-dcpp-clients-show', function jsDcppClientsShowClick(e) {
  e.preventDefault()

  document.querySelectorAll(this.dataset.target).forEach((el) => { el.hidden = false })

  this.hidden = true
})

// Учет кликов по хабам
$(document).on('click', '.js-dcpp-hub', function jsDcppHubClick() {
  const { clicked } = this.dataset

  if (clicked === undefined) {
    axios.post(this.dataset.action)

    this.dataset.clicked = '1'
  }
})
