@extends('life.gigs.base')

{{-- Olympic Gymnastics Arena (KSPO DOME) --}}

@section('content')
@ru
  <p></p>
@endru

@ru
  <p>Коллаж официальных фотографий концерта. С помощью свайпа влево можно посмотреть его полностью.</p>
@en
  <p>Official concert photos collage. Swipe left to see it entirely.</p>
@endru
@include('tpl.pic-collage', ['pic' => 'collage.jpg', 'w' => 5400, 'h' => 540])

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2019.12.20.jpg'])
  <h5 class="mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>I LUV IT</li>
    <li>오늘밤 새 <span class="text-sm text-muted">All Night Long</span></li>
    <li>끝 <span class="text-sm text-muted">The End</span></li>
    <li>내 눈에는 <span class="text-sm text-muted">In My Eyes</span></li>
    <li>New Face</li>
    <li>새 <span class="text-sm text-muted">Bird</span></li>
    <li>GENTLEMAN</li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>나팔바지 <span class="text-sm text-muted">Napal Baji</span></li>
    <li>어땠을까 <span class="text-sm text-muted">What Would Have Been</span></li>
    <li>DADDY</li>
    <li>나 이런 사람이야 <span class="text-sm text-muted">I'm a Guy Like This</span></li>
    <li>White Night</li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>Right Now</li>
    <li>아버지 <span class="text-sm text-muted">Father</span></li>
    <li>흔들어 주세요 <span class="text-sm text-muted">Shake It</span></li>
    <li>낙원 <span class="text-sm text-muted">Paradise</span></li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
  </ol>

  <h5 class="mt-4 mb-1">@ru Сет @en Set @endru 4</h5>
  <ol class="list-inside pl-0" start="19">
    <li>We are the One</li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>Sigh</li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>

  <h5 class="mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="23">
    <li>순정</li>
    <li>쿵따리 샤바라</li>
    <li>Tears</li>
    <li>맨발의 청춘</li>
    <li>와</li>
    <li>Run to you</li>
    <li>기댈곳 <span class="text-sm text-muted">Refuge</span></li>
    <li>왼손잡이</li>
    <li>붉은 노을</li>
    <li>나는 나비</li>
    <li>아파트</li>
    <li>말달리자</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>마지막 장면 <span class="text-sm text-muted">Last Scene</span></li>
  </ol>

  <h5 class="mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="38">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
    <li>언젠가는 <span class="text-sm text-muted">Someday</span></li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
    <li>세월이 가면 <span class="text-sm text-muted">As Time Goes By</span></li>
  </ol>
@endcomponent
@endsection
