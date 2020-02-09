(function () {
  'use strict'

  if ('serviceWorker' in navigator) {
    // Service worker можно установить только с https либо localhost
    // http://www.w3.org/TR/2015/WD-service-workers-20150625/#security-considerations
    if (location.protocol === 'https:' || location.hostname === 'localhost') {
      navigator.serviceWorker.register('/assets/service-worker.js', { scope: '/' })
        .catch(function (e) {
          console.error('service worker не зарегистрировался: ', e)
        })
    }
  }
})()
