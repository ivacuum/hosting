@extends('base')

@section('content_header')
<div class="lead">
@stop

@section('content_footer')
  <p>
    <button class="btn btn-default js-post-map-photos"><i class="fa fa-map-pin"></i> Посмотреть фото на карте</button>
  </p>

  <div id="yandex_map" style="display: none; width: 1000px; height: 600px"></div>
</div>
@stop

@section('js')
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script>
$(function() {
  ymaps.ready(function() {
    var map;
    
    $('.js-post-map-photos').bind('click', function() {
      $(this).attr('disabled', true);
      
      map = new ymaps.Map('yandex_map', {
        center: [59.938531, 30.313497],
        zoom: 11,
        controls: ['default'],
      });
      
      $('img[data-map-lat]').each(function() {
        var lat = $(this).data('map-lat');
        var lon = $(this).data('map-lon');
        var src = $(this).attr('src');
        var width = $(this).attr('width');
        var height = $(this).attr('height');
        
        map.geoObjects.add(new ymaps.Placemark([lat, lon], {
          balloonContent: '<img src="' + src + '" width="' + width / 4 + '">',
        }, {
          iconLayout: 'default#image',
          iconImageHref: src,
          iconImageSize: [width / 20, height / 20],
        }));
      });
      
      $('#yandex_map').show();
      
      $('html, body').animate({
        scrollTop: $('#yandex_map').offset().top
      }, 1000);
    });
  });
});
</script>
@stop
