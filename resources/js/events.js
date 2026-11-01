import PhotoPoints from './photo-points'

export default class EventHandlers {
  static bind() {
    document.addEventListener('click', this.cityMapClick)
    document.addEventListener('click', this.collapse)
    document.addEventListener('click', this.dcppClientsShowClick)
    document.addEventListener('click', this.dcppHubClick)
    document.addEventListener('click', this.magnetClick)
    document.addEventListener('click', this.shareClick)

    // Навигация по заметкам с помощью горячих клавиш
    document.querySelectorAll('.js-trip-shortcuts p').forEach((el) => el.classList.add('js-shortcuts-item'))

    // Промотка к предыдущему абзацу
    // TODO: document.querySelector(document.location.hash).scrollIntoView()
  }

  /**
   * Карта снимков одной поездки
   *
   * @param e
   */
  static cityMapClick(e) {
    const target = e.target.closest('.js-city-map-click')

    if (target === null) {
      return
    }

    e.preventDefault()

    const data = target.dataset
    const container = document.querySelector(`#${data.container}`)

    if (!data.loaded) {
      data.loaded = '1'

      const points = data.action ? PhotoPoints.fetch(data.action) : null

      App.map.create(data.container, data.lat, data.lon, undefined, true)
        .then(() => {
          const manager = PhotoPoints.createManager()

          App.map.map.geoObjects.add(manager)

          return points?.then((collection) => {
            manager.add(collection)

            return EventHandlers.fitPhotoPoints(manager)
          })
        })
    }

    container.classList.toggle('hidden')
  }

  static collapse(e) {
    const target = e.target.closest('.js-collapse')

    if (target === null) {
      return
    }

    e.preventDefault()

    const el = document.querySelector(target.dataset.target)

    el.classList.toggle('hidden')
  }

  /**
   * Показ клиентов DC++ для всех платформ
   *
   * @param e
   */
  static dcppClientsShowClick(e) {
    const target = e.target.closest('.js-dcpp-clients-show')

    if (target === null) {
      return
    }

    e.preventDefault()

    document.querySelectorAll(target.dataset.target).forEach((el) => {
      el.hidden = false
    })

    target.hidden = true
  }

  /**
   * Учет статистики кликов по хабу
   */
  static dcppHubClick(e) {
    const target = e.target.closest('.js-dcpp-hub')

    if (target === null) {
      return
    }

    const { clicked } = target.dataset

    if (clicked === undefined) {
      fetch(target.dataset.action, {
        method: 'POST',
      })

      target.dataset.clicked = '1'
    }
  }

  /**
   * Все снимки поездки в кадре. Приближение ограничено уровнем улиц,
   * чтобы снимки в одной точке не открывали карту на уровне домов
   */
  static fitPhotoPoints(manager) {
    const bounds = manager.getBounds()

    if (bounds === null) {
      return
    }

    const { map, ym } = App.map
    const { center, zoom } = ym.util.bounds.getCenterAndZoom(
      bounds,
      map.container.getSize(),
      map.options.get('projection'),
      { margin: 32 },
    )

    return map.setCenter(center, Math.min(zoom, 16), { checkZoomRange: true })
  }

  /**
   * Учет статистики кликов по магнету
   */
  static magnetClick(e) {
    const target = e.target.closest('.js-magnet')

    if (target === null) {
      return
    }

    const { clicked } = target.dataset

    if (clicked === undefined) {
      fetch(target.dataset.action, {
        method: 'POST',
      })

      target.dataset.clicked = '1'

      const counter = target.querySelector('.js-magnet-counter')

      counter.textContent = String(Number(counter.textContent) + 1)
    }
  }

  static shareClick(e) {
    const target = e.target.closest('.js-share-click')

    if (target === null) {
      return
    }

    if (navigator.share) {
      e.preventDefault()

      const url = target.getAttribute('href') || ''

      navigator.share({ url })
    }
  }
}
