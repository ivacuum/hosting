@extends('life.gigs.base')

{{-- Blue Square SOL Travel Hall --}}

@section('content')
@ru
  <p>При входе в здание персонал отрывает корешок от билета. Следом за этим перед лестницей видна памятка где какая очередь собирается:
  <ul class="mb-4">
    <li>танцпол (первые 200): минус третий этаж;</li>
    <li>танцпол (следующие 200): минус первый этаж;</li>
    <li>танцпол (следующие 200): открытое пространство на улице;</li>
    <li>танцпол (оставшиеся): у главного входа;</li>
    <li>сидячие места: возле касс.</li>
  </ul>
  <p>Так как сцена находится в самом низу на минус четвертом этаже, то очередь организована снизу вверх — чем ближе у тебя место на билете, тем ниже ты ждешь.</p>
@en
  <p>At the entrance, staff tear your ticket stub. Right by the stairs, a sign directs the different queues:</p>
  <ul class="mb-4">
    <li>Dance Floor (First 200): Basement Level 3</li>
    <li>Dance Floor (Next 200): Basement Level 1</li>
    <li>Dance Floor (Next 200): Outside open area</li>
    <li>Dance Floor (Remaining): Main entrance</li>
    <li>Seated Tickets: Box office</li>
  </ul>
  <p>Because the stage is at the very bottom on Basement Level 4, the crowd is organized from the bottom up. The closer your spot is to the stage, the deeper underground you wait.</p>
@endru

@ru
  <p>Странно, что памятка внутри здания, куда входишь с билетом. Видимо, она предназначена для персонала.</p>
@en
  <p>It's strange that the memo is inside the building, which you enter with a ticket. Apparently, it's meant for the staff.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5227.jpg'])

@ru
  <p>Всего один снимок за вечер. В этот раз не было занавеса, как в прошлые два концерта. Сцена сразу была вся видна. Накрыта была только ударная установка. У кого в правом секторе была камера с хорошим зумом, тот мог подглядеть сет-лист вечера еще до начала концерта, потому что лист бумаги со списком песен висел у гитарного техника справа от сцены.</p>
@en
  <p>Only one photo for the evening. This time there was no curtain like at the previous two concerts. The stage was visible right away. Only the drum kit was covered. Those in the right sector with a good zoom camera could peek at the setlist of the evening even before the concert started, because a piece of paper with the list of songs was hanging by the guitar tech on the right side of the stage.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5228.jpg'])

@ru
  <p>Начали с нового альбома <span class="font-bold">Parasomnia</span>. И сыграли его целиком! Это и стало объяснением почему не было занавеса перед началом — он был срежиссирован только под определенную первую песню <span class="font-bold">Metropolis Pt. 1</span>, которую в этот вечер вообще не играли.</p>
@en
  <p>They started with the new album <span class="font-bold">Parasomnia</span>. And played it in its entirety! This explained why there was no curtain before the start — it was directed only for a specific opening song <span class="font-bold">Metropolis Pt. 1</span>, which they didn't play at all this evening.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/dreamtheater.2026.jpg'])
  <ol>
    <li>In the Arms of Morpheus</li>
    <li>Night Terror</li>
    <li>A Broken Man</li>
    <li>Dead Asleep</li>
    <li>Midnight Messiah</li>
    <li>Are We Dreaming?</li>
    <li>Bend the Clock</li>
    <li>The Shadow Man Incident</li>
    <li>As I Am</li>
    <li>The Enemy Inside</li>
    <li>Panic Attack</li>
    <li>Through My Words</li>
    <li>Fatal Tragedy</li>
    <li>Peruvian Skies</li>
    <li>Take the Time</li>
    <li>A Change of Seasons</li>
  </ol>
@endcomponent

@ru
  <p>Вокруг на танцполе была активная молодежь — единомышленники. Если первую часть (новый альбом) мы в основном стояли и слушали, то вторую часть группа начала с трека <span class="font-bold">As I Am</span>, и это был разнос! Вторая часть оказалась максимально бодрой из всех трех концертов — одна ритмичная песня за другой. Мы очень много прыгали с молодежью. Даже Петруччи вдохновили попрыгать в конце <span class="font-bold">Peruvian Skies</span>. Перед <span class="font-bold">Take the Time</span> один из корейцев рядом спросил меня: «Ты готов [зажигать]?». Всегда готов! Это получился лучший концерт из трех, плюс самый продолжительный.</p>
@en
  <p>Around us on the dance floor were energetic young folks — kindred spirits. While we mostly just stood and listened during the first part (the new album), the band kicked off the second part with the track <span class="font-bold">As I Am</span>, and it was a blast! That second half turned out to be the most energetic out of all three concerts — just one driving song after another. We jumped around a ton with the younger crowd. Even Petrucci got inspired to jump at the end of <span class="font-bold">Peruvian Skies</span>. Before <span class="font-bold">Take the Time</span>, a Korean guy next to me asked: "Are you ready [to rock]?". Born ready! This ended up being the best concert of the three, plus the longest one.</p>
@endru

@ru
  <p>Корейцы научены звать артистов на бис. Поэтому все три ночи, когда группа прощалась и свет гас, они неутомимо скандировали «энкор» (encore) вплоть до их возвращения на сцену.</p>
@en
  <p>The Korean fans are well-trained in calling artists back for an encore. That's why on all three nights, when the band said their goodbyes and the lights went down, the crowd tirelessly chanted "encore" right up until they returned to the stage.</p>
@endru

@ru
  <p>Три билета с трех дней концертов.</p>
@en
  <p>Three tickets from the three days of concerts.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5231.jpg'])

@ru
  <p>Видеозапись выступления.</p>
@en
  <p>Video recording of the performance.</p>
@endru
<livewire:youtube title="Dream Theater 2026-02-22, Seoul, Korea" v="3iFRNC1_UlE"/>
@endsection
