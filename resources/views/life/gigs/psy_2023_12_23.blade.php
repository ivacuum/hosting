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
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>GENTLEMAN</li>
    <li>감동이야 <span class="text-sm text-muted">You Move Me</span></li>
    <li>New Face</li>
    <li>밤이 깊었네 <span class="text-sm text-muted">Sleepless</span></li>
    <li>DADDY</li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 2</h5>
  <ol class="list-inside pl-0" start="8">
    <li>Right Now</li>
    <li>오늘밤 새 <span class="text-sm text-muted">All Night Long</span></li>
    <li>어땠을까 <span class="text-sm text-muted">What Would Have Been</span></li>
    <li>흔들어 주세요 <span class="text-sm text-muted">Shake It</span></li>
    <li>낙원 <span class="text-sm text-muted">Paradise</span></li>
    <li>나팔바지 <span class="text-sm text-muted">Napal Baji</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 3</h5>
  <ol class="list-inside pl-0" start="14">
    <li>끝 <span class="text-sm text-muted">The End</span></li>
    <li>I LUV IT</li>
    <li>아버지 <span class="text-sm text-muted">Father</span></li>
    <li>팩트폭행 <span class="text-sm text-muted">Fact</span></li>
    <li>나 이런 사람이야 <span class="text-sm text-muted">I'm a Guy Like This</span></li>
    <li>새 <span class="text-sm text-muted">Bird</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">@ru Сет @en Set @endru 4</h5>
  <ol class="list-inside pl-0" start="20">
    <li>We are the One</li>
    <li>강남스타일 <span class="text-sm text-muted">Gangnam Style</span></li>
    <li>엄마가 딸에게 <span class="text-sm text-muted">Mother to Daughter</span></li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 1</h5>
  <ol class="list-inside pl-0" start="24">
    <li>NUNU NANA</li>
    <li>Rush Hour</li>
    <li>I’m Not Cool</li>
    <li>Happen</li>
    <li>Chili</li>
    <li>That That</li>
    <li>기댈곳 <span class="text-sm text-muted">Refuge</span></li>
    <li>나는 나비</li>
    <li>낭만고양이</li>
    <li>아파트</li>
    <li>말달리자</li>
    <li>그대에게</li>
    <li>여행을 떠나요</li>
    <li>마지막 장면 <span class="text-sm text-muted">Last Scene</span></li>
  </ol>

  <h5 class="font-medium text-lg mt-4 mb-1">Encore 2</h5>
  <ol class="list-inside pl-0" start="38">
    <li>챔피언 <span class="text-sm text-muted">Champion</span></li>
    <li>연예인 <span class="text-sm text-muted">Entertainer</span></li>
    <li>That That</li>
    <li>걱정말아요 그대 <span class="text-sm text-muted">Don't Worry</span></li>
    <li>에술이야 <span class="text-sm text-muted">It's Art</span></li>
  </ol>
@endcomponent
@endsection
