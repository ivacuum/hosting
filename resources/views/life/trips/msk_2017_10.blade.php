@extends('life.trips.base')

@section('content')
@ru
  <p>Парк Зарядье открылся.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_4188.jpg',
  'IMG_4189.jpg',
  'IMG_4190.jpg',
]])

@ru
  <p>На мост пускают только слева. А справа выход.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4191.jpg'])

@ru
  <p>На Москворецкой набережной затор.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4192.jpg'])

@ru
  <p>Лишь на мосту свободно в будний день.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4193.jpg'])

@ru
  <p>Кремль виднеется.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4194.jpg'])

@ru
  <p>Крытое место прекрасно. И не только крышей и защитой от ветра.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4195.jpg'])

@ru
  <p>В дождливый и холодный день восторг вызывают обогреватели наверху.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4196.jpg'])

@ru
  <p>Здесь их десяток-другой. Такие бы теперь на остановки и прочие общественные места.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4197.jpg'])

@ru
  <p>Появятся ли здесь утки?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4198.jpg'])

@ru
  <p>Или здесь.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4201.jpg'])

@ru
  <p>Бззз.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4202.jpg'])

@ru
  <p>Гум.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4204.jpg'])

@ru
  <p>Лестница.</p>
@en
  <p>Stairwell.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4212.jpg'])

@ru
  <p>Фонтан.</p>
@en
  <p>Fountain.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4211.jpg'])

@ru
  <p>Прошло уже почти два месяца с начала изучения иероглифов китайского и японского языков. Первая встреча их в реальной жизни с тех пор. Некоторые части удается распознать.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_4209.jpg'])
@endsection
