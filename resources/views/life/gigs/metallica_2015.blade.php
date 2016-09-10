@extends('life.gigs.base')

{{-- СКК --}}

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <p>Вспоминал как была заполнена площадка <a class="link" href="/life/metallica.2008">семь лет назад</a> во время их шоу, боялся повторения тех адовых условий и духоты. По большому счету они повторились, но самому теперь перенести их было гораздо проще — семь лет подготовки на других концертах дали о себе знать.</p>
      <p>Отличная затея начать шоу с заводной песни Fuel. Побольше бы групп делало ставку на активное начало. В целом сет очень понравился, особенно King Nothing и Turn the Page. Вяло зашли зашли The Frayed Ends of Sanity и Nothing Else Matters.</p>
    @endlang
    @include('tpl.setlist-title')
    <ol>
      <li>Fuel</li>
      <li>For Whom the Bell Tolls</li>
      <li>Blackened</li>
      <li>King Nothing</li>
      <li>Disposable Heroes</li>
      <li>The Day That Never Comes</li>
      <li>The Memory Remains</li>
      <li>The Unforgiven</li>
      <li>Sad But True</li>
      <li>Turn the Page</li>
      <li>The Frayed Ends of Sanity</li>
      <li>One</li>
      <li>Master of Puppets</li>
      <li>Fade to Black</li>
      <li>Seek and Destroy</li>
      <li>Whiskey in the Jar</li>
      <li>Nothing Else Matters</li>
      <li>Enter Sandman</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/metallica.2015.08.25.jpg">
    </div>
  </div>
</div>

@ru
  <p>Каково оно было в фан-зоне:</p>
@en
  <p>What it was like to be in the fan-zone:</p>
@endlang
<div class="fotorama" data-width="720" data-ratio="720/437">
  <a href="https://www.youtube.com/watch?v=WkVGeBGM5yc"></a>
</div>

@ru
  <p>Вообще у <a class="link" href="https://www.youtube.com/channel/UCGp2uNPZCeUTH1BynWSnSUQ/search?query=metallica+2015">этого товарища</a> отличные атмосферные видео вышли. У <a class="link" href="https://www.youtube.com/watch?v=EmCVvp3KbjQ">Sad But True</a>, например, крутое начало — прямо как в 2008 году.</p>
@endlang

@ru
  <p>Кирк Хэмметт <a class="link" href="https://www.youtube.com/watch?v=eUr9c8b7d64&t=1525">поразил своим вторым соло</a> — никогда его не видел таким эмоциональным и заведенным! Самое яркое впечатление вечера!</p>
@endlang

@ru
  <p>Видеозапись концерта.</p>
@endlang
<div class="fotorama" data-width="1000" data-ratio="1000/595">
  <a href="https://www.youtube.com/watch?v=-VQMs8zQRj8"></a>
</div>
@endsection
