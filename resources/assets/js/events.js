class Events {
  // Форма поиска авиабилетов по клику
  static aviasales() {
    $(this).contents().unwrap()

    let s = document.createElement('script')
    s.type = 'text/javascript'
    s.src = 'https://www.travelpayouts.com/widgets/044c854e39d539701be0fa773757da42.js?v=443'
    s.async = true
    document.getElementById('aviasales_container').appendChild(s)
  }

  static cityMapClick(e) {
    e.preventDefault()

    let $el = $(this)
    let $container = $('#' + $el.data('container'))
    const loaded = $el.data('loaded')

    if (!loaded) {
      $el.data('loaded', true)

      App.map.create($el.data('container'), $el.data('lat'), $el.data('lon'), undefined, true)
        .then(() => {
          let manager = new App.map.ym.ObjectManager({
            clusterize: 1,
            gridSize: 64
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

  static gifClick(e) {
    e.preventDefault()

    let $img = $('img', this)
    let src = $img.attr('src')
    let gif = $(this).attr('href')

    if (src != gif) {
      $img.data('static', src).attr('src', gif)
    } else {
      $img.attr('src', $img.data('static'))
    }
  }

  static photosMap() {
    const container = 'photos_map'
    let $el = $(`#${container}`)

    if (!$el.length) return

    App.map.create(container, $el.data('lat'), $el.data('lon'), $el.data('zoom'), true)
      .then(() => {
        let manager = new App.map.ym.ObjectManager({
          clusterize: $el.data('clusterize'),
          gridSize: $el.data('cluster_size')
        })

        manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
        manager.clusters.options.set('preset', 'islands#nightClusterIcons')

        App.map.map.geoObjects.add(manager)

        axios.get($el.data('action')).then((response) => {
          manager.add(response.data)
        })
      })
  }
}

$(document).on('click', '.js-aviasales', Events.aviasales)
$(document).on('click', '.js-city-map-click', Events.cityMapClick)

// Проигрывание гифок по клику
$(document).on('click', '.js-gif-click', Events.gifClick)

// Учет кликов по магнет-ссылкам
$(document).on('click', '.js-magnet', function () {
  const clicked = this.dataset.clicked

  if (clicked === undefined) {
    axios.post(this.dataset.action)

    this.dataset.clicked = 1

    let counter = this.querySelector('.js-magnet-counter')

    counter.textContent = Number(counter.textContent) + 1
  }
})

$(document).on('click', '.js-tick-onclick', function () {
  let $selector = $(this.dataset.tick)
  $selector.prop('checked', function (i, val) {
    return !val
  })
})

$(function () {
  Events.photosMap()
})
