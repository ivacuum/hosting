/** @namespace App.map.ym.ObjectManager */

export default class EventHandlers {
  static bind() {
    document.addEventListener('click', this.cityMapClick)
    document.addEventListener('click', this.collapse)
    $(document).on('click', '.js-dcpp-clients-show', this.dcppClientsShowClick)
    $(document).on('click', '.js-dcpp-hub', this.dcppHubClick)
    $(document).on('click', '.js-magnet', this.magnetClick)

    $(document).on('click', '.js-share-click', this.shareClick)

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

      App.map.create(data.container, data.lat, data.lon, undefined, true)
        .then(() => {
          const manager = new App.map.ym.ObjectManager({
            clusterize: 1,
            gridSize: 64,
          })

          manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
          manager.clusters.options.set('preset', 'islands#nightClusterIcons')

          App.map.map.geoObjects.add(manager)

          if (data.action) {
            fetch(data.action, {
              headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },
            })
              .then(response => response.json())
              .then(json => manager.add(json))
          }
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
    e.preventDefault()

    document.querySelectorAll(this.dataset.target).forEach((el) => {
      el.hidden = false
    })

    this.hidden = true
  }

  /**
   * Учет статистики кликов по хабу
   */
  static dcppHubClick() {
    const { clicked } = this.dataset

    if (clicked === undefined) {
      fetch(this.dataset.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
        },
      })

      this.dataset.clicked = '1'
    }
  }

  /**
   * Учет статистики кликов по магнету
   */
  static magnetClick() {
    const { clicked } = this.dataset

    if (clicked === undefined) {
      fetch(this.dataset.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
        },
      })

      this.dataset.clicked = '1'

      const counter = this.querySelector('.js-magnet-counter')

      counter.textContent = String(Number(counter.textContent) + 1)
    }
  }

  static shareClick(e) {
    if (navigator.share) {
      e.preventDefault()

      const url = this.getAttribute('href') || ''

      navigator.share({ url })
    }
  }
}
