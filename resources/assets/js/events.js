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

  // Операции над несколькими записями
  static batchForm(e) {
    e.preventDefault()

    let $form = $(this)
    let ids = $($form.data('selector') + ':checked').serialize()

    $.post($form.data('url'), $form.serialize() + '&' + ids, (data) => {
      if (data.redirect) {
        document.location = data.redirect
      }
    })
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

  static entityAction(e) {
    e.preventDefault()

    let $this = $(this)
    let confirm_text = $this.data('confirm')

    if ($this.hasClass('disabled')) {
      return false
    }

    if (confirm_text) {
      if (!confirm(confirm_text)) {
        return false
      }
    }

    let method = $this.data('method') || 'post'

    $this.addClass('disabled')

    $.ajax({
      url: $this.attr('href'),
      method: method.toLowerCase() === 'get' ? 'get' : 'post',
      data: { _method: method.toUpperCase() }
    }).done((data) => {
      if (data.status === 'OK') {
        $.pjax({ url: data.redirect, container: App.pjax.container })
      } else {
        // App.addFlashNotification(data.message || 'Что-то пошло не так', 'danger')
        alert(data.message || 'Что-то пошло не так')
      }
    }).fail((jqxhr) => {
      // App.addFlashNotification(`${jqxhr.status} ${jqxhr.statusText}`, 'danger')
      alert(`${jqxhr.status} ${jqxhr.statusText}`)
    })
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

  static passwordEye(e) {
    e.preventDefault()

    let state = $(this).data('state') || 'password'
    let $input = $(this).siblings('.form-control')

    if (state === 'password') {
      $input.attr('type', 'text')
      $(this).data('state', 'text')

      $('.js-password-eye-hide', $(this)).show()
      $('.js-password-eye-show', $(this)).hide()
    } else if (state === 'text') {
      $input.attr('type', 'password')
      $(this).data('state', 'password')

      $('.js-password-eye-hide', $(this)).hide()
      $('.js-password-eye-show', $(this)).show()
    }
  }
}

$(document).on('click', '.js-aviasales', Events.aviasales)
$(document).on('submit', '.js-batch-form', Events.batchForm)
$(document).on('click', '.js-city-map-click', Events.cityMapClick)

// Подтверждение действия
$(document).on('click', '.js-confirm', (e) => confirm($(e.currentTarget).data('confirm')))

// Проигрывание гифок по клику
$(document).on('click', '.js-gif-click', Events.gifClick)

// Редактирование по двойному клику
$(document).on('dblclick', '.js-dblclick-edit', (e) => document.location = $(e.currentTarget).data('dblclick-url'))

// Учет кликов по хабам
$(document).on('click', '.js-dcpp-hub', function() {
  const clicked = $(this).data('clicked')

  if (clicked === undefined) {
    $.post($(this).data('action'))

    $(this).data('clicked', 1)
  }
})

// Учет кликов по магнет-ссылкам
$(document).on('click', '.js-magnet', function() {
  const clicked = $(this).data('clicked')

  if (clicked === undefined) {
    $.post($(this).data('action'))

    $(this).data('clicked', 1)

    $('.js-magnet-counter', $(this)).text(parseInt($(this).text(), 10) + 1)
  }
})

// Возможность посмотреть пароль
$(document).on('click', '.js-password-eye', Events.passwordEye)

// Выбрать все
$(document).on('click', '.js-select-all', function() {
  let is_checked = $(this).prop('checked')
  let $selector = $($(this).data('selector'))
  $selector.prop('checked', is_checked)
})

$(document).on('click', '.js-tick-onclick', function() {
  let $selector = $($(this).data('tick'))
  $selector.prop('checked', function(i, val) {
    return !val
  })
})

$(document).on('click', '.js-entity-action', Events.entityAction)

$(function() {
  Events.photosMap()
})
