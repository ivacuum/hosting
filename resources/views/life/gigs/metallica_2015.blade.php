@extends('life.gigs.base')

{{-- СКК --}}

@section('content')
@ru
  <p>Вспоминал как была заполнена площадка <a class="link" href="metallica.2008">семь лет назад</a> во время их шоу, боялся повторения тех адовых условий и духоты. По большому счету они повторились, но самому теперь перенести их было гораздо проще — семь лет подготовки на других концертах дали о себе знать.</p>
  <p>Отличная затея начать шоу с заводной песни Fuel. Побольше бы групп делало ставку на активное начало. В целом сет очень понравился, особенно King Nothing и Turn the Page. Вяло зашли зашли The Frayed Ends of Sanity и Nothing Else Matters.</p>
@endru
<div class="row">
  <div class="col-md-7">
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
  <p class="mb-1">Каково оно было в фан-зоне:</p>
@en
  <p class="mb-1">What it was like to be in the fan-zone:</p>
@endru
<youtube title="King Nothing + Disposable Heroes" v="WkVGeBGM5yc"></youtube>

@ru
  <p>Вообще у <a class="link" href="https://www.youtube.com/channel/UCGp2uNPZCeUTH1BynWSnSUQ/search?query=metallica+2015">этого товарища</a> отличные атмосферные видео вышли. У <a class="link" href="https://www.youtube.com/watch?v=EmCVvp3KbjQ">Sad But True</a>, например, крутое начало — прямо как в 2008 году.</p>
@endru

@ru
  <p>Кирк Хэмметт <a class="link" href="https://www.youtube.com/watch?v=eUr9c8b7d64&t=1525">поразил своим вторым соло</a> — никогда его не видел таким эмоциональным и заведенным! Самое яркое впечатление вечера!</p>
@endru

@ru
  <p class="mb-1">Видеозапись концерта.</p>
@endru
<youtube title="Metallica 2015, St. Petersburg, Russia" v="-VQMs8zQRj8"></youtube>
@endsection
