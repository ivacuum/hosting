/** @namespace App.map.ym.ObjectManager */

export default class EventHandlers {
  static bind() {
    $(document).on('click', '.js-audio-play', this.audioPlay)
    $(document).on('click', '.js-aviasales', this.aviasalesClick)
    $(document).on('click', '.js-city-map-click', this.cityMapClick)
    $(document).on('click', '.js-dcpp-clients-show', this.dcppClientsShowClick)
    $(document).on('click', '.js-dcpp-hub', this.dcppHubClick)
    $(document).on('click', '.js-gif-click', this.gifClick)
    $(document).on('click', '.js-magnet', this.magnetClick)
    $(document).on('click', '.js-tick-onclick', this.tickOnClick)

    // Навигация по заметкам с помощью горячих клавиш
    document.querySelectorAll('.js-trip-shortcuts p').forEach(el => el.classList.add('js-shortcuts-item'))
  }

  static audioPlay() {
    document.querySelector(this.dataset.selector).play()
  }

  /**
   * Форма поиска авиабилетов по клику
   */
  static aviasalesClick() {
    $(this).contents().unwrap()

    const s = document.createElement('script')
    s.type = 'text/javascript'
    s.src = 'https://www.travelpayouts.com/widgets/044c854e39d539701be0fa773757da42.js?v=443'
    s.defer = true
    document.getElementById('aviasales_container').appendChild(s)
  }

  /**
   * Карта снимков одной поездки
   *
   * @param e
   */
  static cityMapClick(e) {
    e.preventDefault()

    const $el = $(this)
    const $container = $(`#${$el.data('container')}`)
    const loaded = $el.data('loaded')

    if (!loaded) {
      $el.data('loaded', true)

      App.map.create($el.data('container'), $el.data('lat'), $el.data('lon'), undefined, true)
        .then(() => {
          const manager = new App.map.ym.ObjectManager({
            clusterize: 1,
            gridSize: 64,
          })

          manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
          manager.clusters.options.set('preset', 'islands#nightClusterIcons')

          App.map.map.geoObjects.add(manager)

          const action = $el.data('action')

          if (action) {
            axios.get(action).then((response) => {
              manager.add(response.data)
            })
          }
        })
    }

    $container.slideToggle()
  }

  /**
   * Показ клиентов DC++ для всех платформ
   *
   * @param e
   */
  static dcppClientsShowClick(e) {
    e.preventDefault()

    document.querySelectorAll(this.dataset.target).forEach((el) => { el.hidden = false })

    this.hidden = true
  }

  /**
   * Учет статистики кликов по хабу
   */
  static dcppHubClick() {
    const { clicked } = this.dataset

    if (clicked === undefined) {
      axios.post(this.dataset.action)

      this.dataset.clicked = '1'
    }
  }

  /**
   * Проигрывание гифок по клику
   *
   * @param e
   */
  static gifClick(e) {
    e.preventDefault()

    const $img = $('img', this)
    const src = $img.attr('src')
    const gif = $(this).attr('href')

    if (src !== gif) {
      $img.data('static', src).attr('src', gif)
    } else {
      $img.attr('src', $img.data('static'))
    }
  }

  /**
   * Учет статистики кликов по магнету
   */
  static magnetClick() {
    const { clicked } = this.dataset

    if (clicked === undefined) {
      axios.post(this.dataset.action)

      this.dataset.clicked = '1'

      const counter = this.querySelector('.js-magnet-counter')

      counter.textContent = String(Number(counter.textContent) + 1)
    }
  }

  static tickOnClick() {
    const $selector = $(this.dataset.tick)

    $selector.prop('checked', (i, val) => !val)
  }
}
