@extends('base', [
  'meta_keywords' => 'firstvds, first, vds, 1vds, фёствдс, фест вдс, вдс, промо, код, промокод, скидка, купон',
  'meta_description' => 'Скидка 25% на любой тариф для новых пользователей FirstVDS.',
])

@section('content')
<div class="text-center center-block" style="max-width: 600px;">
  <img src="https://ivacuum.org/i/services/firstvds.png" width="135" height="72" onclick="location.href='https://firstvds.ru/?from=149161'">
  <h1 class="mb-5">{{ trans('coupons.firstvds.subject') }}</h1>
  @ru
    <p>Укажите вашу электронную почту, и мы пришлем вам код для получения скидки 25% на первый заказ.</p>
  @en
    <p>Type your e-mail and we will send you a promo code for 25% discount to your first order on any FirstVDS plan.</p>
  @endlang
  <form action="{{ path('Coupons@firstvdsPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <input class="form-control d-inline-block align-middle" type="email" name="email" placeholder="{{ trans('coupons.your_email') }}" style="width: 16rem;">
    <input class="btn btn-primary d-inline-block" value="{{ trans('coupons.get_promocode') }}">
    @if ($errors->has('email'))
      <span class="has-error">
        <span class="help-block">{{ $errors->first('email') }}</span>
      </span>
    @endif

    {{ csrf_field() }}
  </form>

  <section>
    <div class="h2 mt-5 mb-3">@ru Хотите способ проще? @en Looking for an easier way? @endlang</div>
    @ru
      <p>Перейдите по ссылке для автоматического применения скидки к вашему первому заказу.</p>
    @en
      <p>Follow the link to automatically apply discount to your first order.</p>
    @endlang
    <div><button class="btn btn-primary" onclick="location.href='https://firstvds.ru/?from=149161'">@ru Получить скидку 25% @en Get a 25% discount @endlang</button></div>
    <span class="help-block">
      @ru
        После клика вы будете перемещены на сайт firstvds.ru
      @en
        After a click you will be redirected to firstvds.ru
      @endlang
    </span>
  </section>
</div>
@endsection
