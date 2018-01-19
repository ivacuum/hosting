import io from 'vac-gfe/js/intersection-observer'

export default function () {
  return io('.js-news-views-observer', {
    rootMargin: '50px 0px',
    threshold: 1,

    callback(el) {
      App.beacon_data.push({
        'id': el.dataset.id,
        'event': 'NewsViewed'
      })
    }
  })
}
