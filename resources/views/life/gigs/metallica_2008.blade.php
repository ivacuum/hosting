@extends('life.gigs.base')

{{-- СКК --}}

@section('content')
@ru
  <p>В 2007 году посетить шоу Металлики в Лужниках не удалось, в то время был в <a class="link" href="sharm-el-sheikh.2007">Египте</a>. Но после него группа сказала, что паузу в 16 лет больше делать не будет — следующий концерт состоится очень скоро. Действительно, новая петербургская дата отстояла ровно на один год и один день от московской.</p>
  <p>В то время еще не знал способов получить билет в родной Калуге, поэтому отправился за ним в Москву в офис Кассир.ру на Новослободской. Бронь после звонка действовала как минимум сутки, поэтому времени добраться было достаточно. Экспресс Калуга–Москва по студенческому стоил смешные 100 ₽. Подобная вылазка за билетом повторится спустя два года для <a class="link" href="rammstein.2010">концерта Раммштайна</a>.</p>
  <p>Всю воду отобрали на входе. Около пяти часов дня был сделан последний глоток воды. Казалось, что свалюсь, если после No Remorse будут играть какую-нибудь Damage Inc, но нет — обошлось, следующей была легкая Fade to Black. Закончился концерт в двенадцатом часу ночи. Десятки тысяч людей высыпали на улицы, образовались километровые очереди за водой во всех встречающихся по пути магазинах. Вместе с тем дело подходило к закрытию метро, а нужно было попасть на Крестовский остров. Волевым решением стало топать в сторону следующей станции. Пошел на удивление в правильную сторону. По пути некий товарищ, тоже посетивший концерт, завязал беседу. Добрались до станции метро Электросила. У чела не было жетона для проезда, у меня же была чужая студенческая карта (отдельная история). Сообщил ему, что ждать не буду. И правильно сделал, так как в кассы была приличная очередь, а я бегом успел на последний поезд. Откуда же он пришел? От Парка Победы. А что в нем интересного? Это ближайшая станция к месту проведения концерта, в которую я не рискнул отстаивать очередь. И этот поезд был битком. И снаружи стояло столько же людей, сколько уже было в составе. В вагоны залезали чуть ли не с разбегу. Влезли все, но пошевелиться потом было нереально.</p>
  <p>За полночь удалось добраться до Крестовского острова. В ближайшей палатке было куплено три полулитровых бутылки воды, так как других не было. Две из них было выпито залпом. Фух, выжил.</p>
@endru

<div class="md:flex md:-mx-4">
  <div class="md:w-7/12 md:px-4">
    @include('tpl.setlist-title')
    <ol>
      <li>
        <a class="link" href="https://vk.com/video_ext.php?oid=169906990&id=162953982&hash=598cee4929696e81&hd=1">
          Creeping Death
        </a>
      </li>
      <li>For Whom the Bell Tolls</li>
      <li>Ride the Lightning</li>
      <li>Harvester of Sorrow <span class="text-sm text-muted">(followed by Kirk's solo incl. The Sails of Charon)</span></li>
      <li>The Unforgiven <span class="text-sm text-muted">(w/ acoustic The Call of Ktulu intro)</span></li>
      <li>Leper Messiah</li>
      <li>...And Justice for All</li>
      <li>No Remorse</li>
      <li>Fade to Black</li>
      <li>Master of Puppets</li>
      <li>Whiplash</li>
      <li>Nothing Else Matters</li>
      <li>Sad But True</li>
      <li>One</li>
      <li>Enter Sandman</li>
      <li>Last Caress <span class="text-sm text-muted">(Misfits cover)</span></li>
      <li>Motorbreath</li>
      <li>Seek &amp; Destroy <span class="text-sm text-muted">(w/ Let There Be Rock outro)</span></li>
    </ol>
  </div>
  <div class="md:w-5/12 md:px-4">
    <div class="mb-6 text-center mobile-wide">
      <img class="image-fit-viewport max-w-full sm:rounded" src="https://life.ivacuum.org/gigs/metallica.2008.07.18.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозаписи концерта.</p>
@endru
<youtube title="Metallica 2008, Saint Petersburg, Russia" v="s3l5cyVLrTs"></youtube>
<youtube title="Metallica — Nothing Else Matters" v="J1pyT7G5dhY"></youtube>
@endsection
