@extends('life.gigs.base')

{{-- Olympic Gymnastics Arena (KSPO DOME) --}}

@section('content')
@ru
  <p></p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/psy.2019.12.20.jpg'])
  <h5 class="font-medium text-lg mb-1">@ru Сет @en Set @endru 1</h5>
  <ol class="list-inside pl-0">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>Right Now</li>
    <li>오늘밤 새 <span class="text-sm text-muted">All Night Long</span></li>
    <li>내 눈에는 <span class="text-sm text-muted">In My Eyes</span></li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>GANJI</li>
    <li>새 <span class="text-sm text-muted">Bird</span></li>
    <li>9INTRO</li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>GENTLEMAN</li>
    <li>CELEB</li>
    <li>어땠을까 <span class="text-sm text-muted">What Would Have Been</span></li>
    <li>DADDY</li>
    <li>흔들어 주세요 <span class="text-sm text-muted">Shake It</span></li>
    <li>감동이야 <span class="text-sm text-muted">You Move Me</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>아버지 <span class="text-sm text-muted">Father</span></li>
    <li>New Face</li>
    <li>I LUV IT</li>
    <li>나팔바지 <span class="text-sm text-muted">Napal Baji</span></li>
    <li>낙원 <span class="text-sm text-muted">Paradise</span></li>
    <li>We are the One</li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 4</h5>
  <ol class="list-inside pl-0" start="20">
    <li>That That</li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
    <li>Dream</li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="24">
    <li>순정</li>
    <li>쿵따리 샤바라</li>
    <li>Tears</li>
    <li>맨발의 청춘</li>
    <li>와</li>
    <li>Run to you</li>
    <li>?</li>
    <li>기댈곳 <span class="text-sm text-muted">Refuge</span></li>
    <li>붉은 노을</li>
    <li>나는 나비</li>
    <li>아파트</li>
    <li>말달리자</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>마지막 장면 <span class="text-sm text-muted">Last Scene</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="39">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>That That</li>
    <li>걱정말아요 그대 <span class="text-sm text-muted">Don't Worry</span></li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>
@endcomponent
@endsection
