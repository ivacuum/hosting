import io from './intersection-observer'

export default function () {
  return io('.js-news-views-observer', {
    rootMargin: '50px 0px',
    threshold: 1,

    callback(el) {
      App.beacon.push({
        id: el.dataset.id,
        event: 'NewsViewed',
      })
    },
  })
}
