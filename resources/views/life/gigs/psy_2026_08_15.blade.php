@extends('life.gigs.base')

{{-- Busan Asiad Stadium --}}

@section('content')
@ru
  <p>Так как рядом со стадионом есть станция метро, значит добраться можно за предсказуемое время. Поехал с паспортом к 14:00 к самому началу выдачи билетов, чтобы их забрать. Далее оставалось поесть, вернуться в отель, скинуть паспорт и другие лишние предметы, наклеить пластырь на ноги от натирающих в паре мест кроксов и намазаться солнцезащитным кремом. Все шло неплохо до момента поездки после еды до отеля. Почувствовал, что дотерпеть и доехать до отеля не смогу — надо срочно сбрасывать балласт. Хорошо, что туалет есть на каждой станции метро. Затем подсчет показал, что пытаться добраться до отеля уже рискованно, потому что можно тогда не успеть на вход по номеру на билете, а терять место не хотелось. Было решено ехать обратно на стадион с лишними предметами и без всей задуманной подготовки.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2026.08.15.gif'])
  <h5 class="font-medium text-lg mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>나팔바지 <span class="text-sm text-gray-500">Napal Baji</span></li>
    <li>연예인 <span class="text-sm text-gray-500">Entertainer</span></li>
    <li>감동이야 <span class="text-sm text-gray-500">You Move Me</span></li>
    <li>That That</li>
    <li>New Face</li>
    <li>낙원 <span class="text-sm text-gray-500">Paradise</span></li>
    <li>에술이야 <span class="text-sm text-gray-500">It's Art</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>GENTLEMAN</li>
    <li>Right Now</li>
    <li>어땠을까 <span class="text-sm text-gray-500">What Would Have Been</span></li>
    <li>DADDY</li>
    <li>아버지 <span class="text-sm text-gray-500">Father</span></li>
    <li>I LUV IT</li>
    <li>뜨거운 안녕 <span class="text-sm text-gray-500">Passionate goodbye</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="15">
    <li>간지 <span class="text-sm text-gray-500">GANJI</span></li>
    <li>오늘밤 새 <span class="text-sm text-gray-500">All Night Long</span></li>
    <li>밤이 깊었네 <span class="text-sm text-gray-500">Sleepless</span></li>
    <li>흔들어 주세요 <span class="text-sm text-gray-500">Shake It</span></li>
    <li>이젠 그랬으면 좋겠네 <span class="text-sm text-gray-500">Let It Be</span></li>
    <li>강남스타일 <span class="text-sm text-gray-500">Gangnam Style</span></li>
    <li>We are the One</li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="22">
    <li>바람났어</li>
    <li>쏘리쏘리</li>
    <li>Nobody</li>
    <li>내가 제일 잘나가</li>
    <li>Tears</li>
    <li>FANTASTIC BABY</li>
    <li>뱅뱅뱅</li>
    <li>이제는 MR <span class="text-sm text-gray-500">NOW</span></li>
    <li>기댈곳 <span class="text-sm text-gray-500">Refuge</span></li>
    <li>나는 나비</li>
    <li>낭만고양이</li>
    <li>아파트</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>마지막 장면 <span class="text-sm text-gray-500">Last Scene</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="37">
    <li>챔피언 <span class="text-sm text-gray-500">Champion</span></li>
    <li>걱정말아요 그대 <span class="text-sm text-gray-500">Don't Worry</span></li>
    <li>연예인 <span class="text-sm text-gray-500">Entertainer</span></li>
    <li>에술이야 <span class="text-sm text-gray-500">It's Art</span></li>
  </ol>
@endcomponent

@ru
  <p>Доставал телефон за концерт три раза на минутку. На третий раз он не разблокировался автоматически и выдал сообщение, что фейс айди недоступен. Позднее оказалось, что вода попала внутрь корпуса телефона. Камера внешне выглядела словно покрытая инеем. Залило еще и задние камеры, отказал модуль вай-фай, иногда не распознавалась батарея и телефон мог в любой момент выключиться или перезагрузиться. В общем, телефон стал непригоден для использования.</p>
@endru
@endsection
