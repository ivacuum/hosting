@extends('photos.base')

@section('content')
@component('accordion')
@slot('title')
@ru Что это за ресурс? @en What is this site section? @endlang
@endslot

@ru
  <p>Фотографии, сделанные мною во время различных поездок. Большинство из них содержит метки геолокации, позволяющие посмотреть место снимка на карте. Все фотографии закреплены за историями о поездках. Также присутствует ручная разбивка по темам (тэги).</p>
@en
  <p>The photos I took during my trips. Most of them have geotags included, so you can look up a pic on the map. All photos are linked with the stories about my trips. There are manually added tags as well.</p>
@endlang
@endcomponent

@component('accordion')
@slot('title')
@ru Что за данные рядом со снимком? @en What is the data on the side of the photo? @endlang
@endslot

@ru
  <p><strong>История</strong> — ссылка на заметку о поездке. Вы попадете именно в то место страницы, где была использована выбранная фотография.</p>
  <p><strong>Геотэги</strong> — город и страна съемки. Позволяют фильтровать снимки.</p>
  <p>
    @svg (map-marker)
    — место снимка на карте.
  </p>
  <p><strong>Тэги</strong> — темы снимка. Обеспечивают возможность посмотреть все фонтаны или, например, все закаты.</p>
@en
  <p><strong>Story</strong> — link to the story about my trip, where I took the photo. You gonna get to certain place of the page, where the photo was used.</p>
  <p><strong>Geotags</strong> — the city and the country of the shooting. Useful for filtering.</p>
  <p>
    @svg (map-marker)
    — place of the shooting on the map.
  </p>
  <p><strong>Tags</strong> — topics of the photo. This way you can view all the fountains, sunsets, etc.</p>
@endlang
@endcomponent
@endsection
