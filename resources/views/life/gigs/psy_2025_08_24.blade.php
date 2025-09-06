@extends('life.gigs.base')

{{-- Gwangju Chosun University Sports Complex --}}

@section('content')
@ru
  <p></p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2025.08.23.jpg'])
  <h5 class="font-medium text-lg mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>챔피언 <span class="text-sm text-gray-500">Champion</span></li>
    <li>에술이야 <span class="text-sm text-gray-500">It's Art</span></li>
    <li>낙원 <span class="text-sm text-gray-500">Paradise</span></li>
    <li>흔들어 주세요 <span class="text-sm text-gray-500">Shake It</span></li>
    <li>Right Now</li>
    <li>감동이야 <span class="text-sm text-gray-500">You Move Me</span></li>
    <li>I LUV IT</li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>That That</li>
    <li>오늘밤 새 <span class="text-sm text-gray-500">All Night Long</span></li>
    <li>어땠을까 <span class="text-sm text-gray-500">What Would Have Been</span></li>
    <li>나팔바지 <span class="text-sm text-gray-500">Napal Baji</span></li>
    <li>아버지 <span class="text-sm text-gray-500">Father</span></li>
    <li>DADDY</li>
    <li>뜨거운 안녕 <span class="text-sm text-gray-500">Passionate goodbye</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>GANJI x GENTLEMAN</li>
    <li>밤이 깊었네 <span class="text-sm text-gray-500">Sleepless</span></li>
    <li>New Face</li>
    <li>흰수염고래 <span class="text-sm text-gray-500">Blue Whale</span></li>
    <li>강남스타일 <span class="text-sm text-gray-500">Gangnam Style</span></li>
    <li>연예인 <span class="text-sm text-gray-500">Entertainer</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="20">
    <li>바람났어</li>
    <li>쏘리쏘리</li>
    <li>Nobody</li>
    <li>내가 제일 잘나가</li>
    <li>Tears</li>
    <li>FANTASTIC BABY</li>
    <li>뱅뱅뱅</li>
    <li>NOW MR</li>
    <li>기댈곳 <span class="text-sm text-gray-500">Refuge</span></li>
    <li>나는 나비</li>
    <li>낭만고양이</li>
    <li>아파트</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>승리를 위하여</li>
    <li>마지막 장면 <span class="text-sm text-gray-500">Last Scene</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="37">
    <li>챔피언 <span class="text-sm text-gray-500">Champion</span></li>
    <li>걱정말아요 그대 <span class="text-sm text-gray-500">Don't Worry</span></li>
    <li>에술이야 <span class="text-sm text-gray-500">It's Art</span></li>
  </ol>
@endcomponent
@endsection
