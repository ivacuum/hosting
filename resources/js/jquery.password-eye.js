// Возможность посмотреть пароль
$(document).on('click', '.js-password-eye', function jsPasswordEye(e) {
  e.preventDefault()

  const state = this.dataset.state || 'password'
  const $input = $(this).siblings('.form-input')

  if (state === 'password') {
    $input.attr('type', 'text')
    this.dataset.state = 'text'

    document.querySelector('.js-password-eye-hide').hidden = false
    document.querySelector('.js-password-eye-show').hidden = true
  } else if (state === 'text') {
    $input.attr('type', 'password')
    this.dataset.state = 'password'

    document.querySelector('.js-password-eye-hide').hidden = true
    document.querySelector('.js-password-eye-show').hidden = false
  }
})
