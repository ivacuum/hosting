const defaults = {
  rootMargin: '0px',
  threshold: 0,

  callback(el) {},
  fallback(el) {},
}

/**
 * @param {Function} callback
 */
const onIntersection = (callback) => (entries, observer) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      observer.unobserve(entry.target)

      callback(entry.target)
    }
  })
}

export default function (selector = '.js-intersection-observer', options = {}) {
  const {
    rootMargin,
    threshold,
    callback,
    fallback,
  } = Object.assign(defaults, options)
  let observer

  if (window.IntersectionObserver) {
    observer = new IntersectionObserver(onIntersection(callback), {
      rootMargin,
      threshold,
    })
  }

  return {
    observe() {
      document.querySelectorAll(selector).forEach((el) => {
        if (observer) {
          observer.observe(el)
          return
        }

        fallback(el)
      })
    },
  }
}
