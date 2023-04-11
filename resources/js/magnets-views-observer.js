import io from './intersection-observer'

export default function () {
  return io('.js-magnets-views-observer', {
    rootMargin: '0px',
    threshold: 1,

    callback(el) {
      App.beacon.push({
        id: el.dataset.id,
        event: 'TorrentViewed',
      })
    },
  })
}
