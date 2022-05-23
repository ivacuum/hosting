// Возможность посмотреть пароль
document.addEventListener('click', (e) => {
  const target = e.target.closest('.js-password-eye')

  if (target === null) {
    return
  }

  e.preventDefault()

  const state = target.dataset.state || 'password'
  const input = target.parentNode.querySelector('.form-input')

  if (state === 'password') {
    input.setAttribute('type', 'text')
    target.dataset.state = 'text'

    document.querySelector('.js-password-eye-hide').hidden = false
    document.querySelector('.js-password-eye-show').hidden = true
  } else if (state === 'text') {
    input.setAttribute('type', 'password')
    target.dataset.state = 'password'

    document.querySelector('.js-password-eye-hide').hidden = true
    document.querySelector('.js-password-eye-show').hidden = false
  }
})
