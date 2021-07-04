@extends('life.base')

{{-- http://www.flaticon.com/packs/laundry-and-washing --}}

@section('content')
<h1 class="h2">Условные обозначения стирки</h1>
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8 text-center">
  <div>
    <svg class="svg-icon text-5xl" viewBox="0 0 199.002 199.002"><path d="M192.876,29.056c-3.828-0.475-7.337,2.234-7.82,6.07l-2.711,21.521c-1.084-0.132-2.161-0.223-3.221-0.223 c-4.167,0-8.361,0.975-12.823,2.981c-3.779,1.699-7.368,3.981-10.839,6.188c-3.191,2.03-6.205,3.946-9.066,5.233 c-2.619,1.178-4.936,1.75-7.083,1.75s-4.463-0.572-7.083-1.75c-2.861-1.286-5.875-3.203-9.072-5.236 c-3.47-2.206-7.058-4.487-10.833-6.184c-3.278-1.474-7.313-2.981-12.378-2.981c-4.281,0-8.993,1.059-13.268,2.981 c-3.776,1.697-7.364,3.979-10.84,6.188c-3.191,2.03-6.205,3.946-9.066,5.233c-2.619,1.178-4.936,1.75-7.082,1.75 s-4.463-0.572-7.083-1.75c-2.861-1.286-5.875-3.203-9.067-5.232c-3.471-2.207-7.059-4.489-10.838-6.188 c-4.462-2.006-8.657-2.981-12.824-2.981c-1.059,0-2.137,0.091-3.221,0.223l-2.711-21.521c-0.483-3.835-3.982-6.55-7.82-6.07 c-3.835,0.483-6.553,3.984-6.07,7.82l13.827,109.748c1.679,13.328,13.074,23.377,26.507,23.377h118.224 c13.433,0,24.828-10.05,26.507-23.377l13.827-109.748C199.429,33.04,196.711,29.539,192.876,29.056z M171.229,144.875 c-0.799,6.343-6.223,11.126-12.616,11.126H40.389c-6.394,0-11.817-4.784-12.616-11.127L18.405,70.52 c0.499-0.058,0.991-0.096,1.473-0.096c2.146,0,4.463,0.572,7.083,1.75c2.859,1.285,5.875,3.202,9.066,5.232 c3.47,2.207,7.057,4.488,10.839,6.188c8.925,4.013,16.725,4.012,25.646,0c3.782-1.7,7.37-3.982,10.843-6.191 c3.191-2.029,6.206-3.946,9.063-5.23c2.437-1.096,5.251-1.75,7.527-1.75c1.975,0,3.836,0.491,6.638,1.75 c2.856,1.284,5.871,3.2,9.066,5.232c3.47,2.207,7.057,4.488,10.839,6.188c4.461,2.006,8.656,2.981,12.823,2.981 s8.361-0.975,12.823-2.981c3.782-1.7,7.37-3.982,10.838-6.188c3.192-2.03,6.208-3.947,9.067-5.233 c2.619-1.178,4.936-1.75,7.083-1.75c0.482,0,0.974,0.039,1.473,0.096L171.229,144.875z"/></svg>
    <div><a class="pseudo" href="#wash">Стирка</a></div>
  </div>
  <div>
    <svg class="svg-icon text-5xl" viewBox="0 0 191.736 191.736"><path d="M184.736,0H7C3.134,0,0,3.134,0,7v177.736c0,3.866,3.134,7,7,7h177.736c3.866,0,7-3.134,7-7V7 C191.736,3.134,188.603,0,184.736,0z M177.736,177.736H14V14h163.736V177.736z"/></svg>
    <div><a class="pseudo" href="#dry">Сушка</a></div>
  </div>
  <div>
    <svg class="svg-icon text-5xl" viewBox="0 0 191.736 191.736"><path d="M184.736,0H7C3.134,0,0,3.134,0,7v177.736c0,3.866,3.134,7,7,7h177.736c3.866,0,7-3.134,7-7V7 C191.736,3.134,188.603,0,184.736,0z M177.736,177.736H14V14h163.736V177.736z"/><path d="M95.868,161.496c36.188,0,65.628-29.44,65.628-65.628S132.056,30.24,95.868,30.24S30.24,59.681,30.24,95.868 S59.681,161.496,95.868,161.496z M95.868,44.24c28.468,0,51.628,23.16,51.628,51.628s-23.16,51.628-51.628,51.628 S44.24,124.336,44.24,95.868S67.4,44.24,95.868,44.24z"/></svg>
    <div><a class="pseudo" href="#dryer">Отжим и сушка</a></div>
  </div>
  <div>
    <svg class="svg-icon text-5xl" viewBox="0 0 222 222"><path d="M221.805,165.276l-18.667-77.444c-0.244-1.016-0.713-1.963-1.372-2.774c-19.095-23.498-47.411-36.974-77.688-36.974H53.611 c-3.866,0-7,3.134-7,7s3.134,7,7,7h70.466c20.653,0,40.246,7.291,55.663,20.389H83.838c-21.052,0-41.166,7.862-56.637,22.138 s-24.922,33.694-26.61,54.678l-0.568,7.067c-0.156,1.948,0.508,3.872,1.833,5.308s3.19,2.253,5.145,2.253h208 c2.146,0,4.172-0.983,5.499-2.669C221.826,169.562,222.308,167.362,221.805,165.276z M14.588,159.916 c3.123-35.618,33.445-63.444,69.25-63.444h106.981l15.293,63.444H14.588z"/></svg>
    <div><a class="pseudo" href="#iron">Глажка</a></div>
  </div>
  <div>
    <svg class="svg-icon text-5xl" viewBox="0 0 168 168"><path d="M84,0C37.683,0,0,37.682,0,84s37.683,84,84,84s84-37.682,84-84S130.317,0,84,0z M84,154c-38.598,0-70-31.402-70-70 s31.402-70,70-70s70,31.402,70,70S122.598,154,84,154z"/></svg>
    <div><a class="pseudo" href="#dry-cleaning">Химчистка</a></div>
  </div>
  <div>
    <svg class="svg-icon text-5xl" viewBox="0 0 184.58 184.58"><path d="M182.004,146.234L108.745,19.345c-3.435-5.949-9.586-9.5-16.455-9.5s-13.021,3.551-16.455,9.5L2.576,146.234 c-3.435,5.948-3.435,13.051,0,19c3.435,5.949,9.586,9.5,16.455,9.5h146.518c6.869,0,13.021-3.552,16.455-9.5 C185.438,159.285,185.438,152.182,182.004,146.234z M169.88,158.234c-0.435,0.751-1.725,2.5-4.331,2.5H19.031 c-2.606,0-3.896-1.749-4.331-2.5c-0.434-0.752-1.302-2.744,0.001-5L87.96,26.345c1.303-2.256,3.462-2.5,4.33-2.5 s3.027,0.244,4.33,2.5l73.259,126.889C171.181,155.49,170.313,157.482,169.88,158.234z"/></svg>
    <div><a class="pseudo" href="#bleach">Отбеливание</a></div>
  </div>
</div>

<section id="wash">
  <h3>Стирка</h3>
  <p>Подчеркивание — щадящий режим. Два подчеркивания — деликатный режим.</p>
</section>

<section id="dry">
  <h3>Сушка</h3>
  <p>Вертикальные линии внутри — сушить вертикально. Горизонтальные — горизонтально. Линии в углу — сушить в затененном месте.</p>
</section>

<section id="dryer">
  <h3>Отжим и сушка</h3>
  <p>Подчеркивание — щадящие условия отжима и сушки, пунктир — деликатные.</p>
  <div>Температурный режим сушки:</div>
  <div>&bull; — низкая температура,</div>
  <div>&bull;&bull; — умеренная,</div>
  <div>&bull;&bull;&bull; — высокая.</div>
</section>

<section id="iron" class="pt-12">
  <h3>Глажка</h3>
  <p>Скрещенные линии под подошвой утюга запрещают отпаривание.</p>
  <div>Точки внутри символизируют температурный режим:</div>
  <div>&bull; — до 100&deg;C,</div>
  <div>&bull;&bull; — до 150&deg;C,</div>
  <div>&bull;&bull;&bull; — до 200&deg;C.</div>
</section>

<section id="dry-cleaning" class="pt-12">
  <h3>Химчистка</h3>
  <p>Пустой круг — можно отдать в химчистку, перечеркнутый — нельзя.</p>
</section>

<section id="bleach">
  <h3>Отбеливание</h3>
  <p>Пустой треугольник — можно отбеливать, перечеркнутый — нельзя.</p>
</section>

<div></div>
@endsection
