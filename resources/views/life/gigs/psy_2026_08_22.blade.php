@extends('life.gigs.base')

{{-- Mokwon University Stadium --}}

@section('content')
@ru
  <p>Понравилось, что концерты в Тэджоне запланировали в кампусе университета, потому что в прошлом году в Кванджу кампус был красивой локацией с отличным звуком. Звук в Тэджоне тоже оказался отличным, в частности чище и мощнее Пусана.</p>
@endru

@ru
  <p>Были ожидания, что добираться к площадке и обратно будет тяжело, потому что до ближайшей станции метро час пешком, а автобусов на более чем двадцать тысяч желающих не хватит. Нам повезло, что оба дня мы за считанные 500 ₽ легко вызвали такси и быстро добрались в прохладном комфорте.</p>
@endru

@ru
  <p>За два часа до начала концерта прошел мощный ливень, который намочил всех не меньше, чем впоследствии бы намочило водное шоу. Из-за ливня температура воздуха понизилась на несколько градусов, что временами на ветру было даже прохладно.</p>
@endru

@ru
  <p>Сначала привел нашу компанию в очередь не в тот сектор. Никто из сотрудников не проверял в ту ли очередь мы встали и в нужное ли место. Когда перешли в нужную — тоже никто не проверил.</p>
@endru

@ru
  <p>Забавно, что билет на третьего человека покупал будучи в эпл сторе в Сеуле несколькими днями ранее. Люди сдавали ненужные билеты в предверии повышения комиссии за возврат.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2026.08.22.gif'])
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
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>간지 <span class="text-sm text-gray-500">GANJI</span></li>
    <li>오늘밤 새 <span class="text-sm text-gray-500">All Night Long</span></li>
    <li>밤이 깊었네 <span class="text-sm text-gray-500">Sleepless</span></li>
    <li>흔들어 주세요 <span class="text-sm text-gray-500">Shake It</span></li>
    <li>이젠 그랬으면 좋겠네 <span class="text-sm text-gray-500">Let It Be</span></li>
    <li>강남스타일 <span class="text-sm text-gray-500">Gangnam Style</span></li>
    <li>We are the One</li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="21">
    <li>바람났어</li>
    <li>쏘리쏘리</li>
    <li>Nobody</li>
    <li>내가 제일 잘나가</li>
    <li>Tears</li>
    <li>FANTASTIC BABY</li>
    <li>뱅뱅뱅</li>
    <li>뜨거운 안녕 MR <span class="text-sm text-gray-500">Passionate goodbye</span></li>
    <li>기댈곳 <span class="text-sm text-gray-500">Refuge</span></li>
    <li>나는 나비</li>
    <li>낭만고양이</li>
    <li>아파트</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>마지막 장면 <span class="text-sm text-gray-500">Last Scene</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="36">
    <li>챔피언 <span class="text-sm text-gray-500">Champion</span></li>
    <li>걱정말아요 그대 <span class="text-sm text-gray-500">Don't Worry</span></li>
    <li>연예인 <span class="text-sm text-gray-500">Entertainer</span></li>
    <li>에술이야 <span class="text-sm text-gray-500">It's Art</span></li>
  </ol>
@endcomponent

@ru
  <p>Повезло выходить с территории проведения концерта и неожиданно попасть в первых рядах под выходящий на маршрут 706 автобус, который был ближайшим до отеля.</p>
@endru
@endsection
