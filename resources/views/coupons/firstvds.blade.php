@extends('base', [
  'metaKeywords' => 'firstvds, first, vds, 1vds, фёствдс, фест вдс, вдс, промо, код, промокод, скидка, купон',
  'metaDescription' => 'Скидка 25% на любой тариф для новых пользователей FirstVDS.',
])

@section('content')
<div class="max-w-600px">
  <img src="https://ivacuum.org/i/services/firstvds.png" width="135" height="72" onclick="location.href='https://firstvds.ru/?from=149161'" alt="">
  <h1 class="mt-6">{{ trans('coupons.firstvds.subject') }}</h1>
  @ru
    <p>Укажите вашу электронную почту, и мы пришлем вам код для получения скидки 25% на первый заказ.</p>
  @en
    <p>Type your e-mail and we will send you a promo code for 25% discount to your first order on any FirstVDS plan.</p>
  @endru
  <form action="{{ path([App\Http\Controllers\Coupons::class, 'firstvdsPost']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="max-w-500px">
      <div class="flex w-full">
        <input
          required
          class="form-control rounded-r-none {{ $errors->has('email') ? 'is-invalid' : '' }}"
          type="email"
          name="email"
          autocomplete="email"
          placeholder="{{ trans('coupons.your_email') }}"
        >
        <button class="btn btn-primary -ml-px rounded-l-none whitespace-no-wrap">{{ trans('coupons.get_promocode') }}</button>
      </div>
      @if ($errors->has('email'))
        <div class="invalid-feedback block">{{ $errors->first('email') }}</div>
      @endif
    </div>
  </form>

  <section class="mt-12">
    <div class="h2">@ru Хотите способ проще? @en Looking for an easier way? @endru</div>
    @ru
      <p>Перейдите по ссылке для автоматического применения скидки к вашему первому заказу.</p>
    @en
      <p>Follow the link to automatically apply discount to your first order.</p>
    @endru
    <div><button class="btn btn-primary" onclick="location.href='https://firstvds.ru/?from=149161'">@ru Получить скидку 25% @en Get a 25% discount @endru</button></div>
    <div class="form-help">
      @ru
        После клика вы будете перемещены на сайт firstvds.ru
      @en
        After a click you will be redirected to firstvds.ru
      @endru
    </div>
  </section>
</div>
@endsection
