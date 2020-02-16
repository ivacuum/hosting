window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window['AppOptions'].csrfToken
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
