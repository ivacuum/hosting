# Coupons

Verify the coupon directory, service advice, and referral destinations without making external purchases.

## Sub-features

- `coupons-directory` covers `GET /promocodes-coupons` and all service entries.
- `coupons-services` covers `GET /promocodes-coupons/airbnb`, `/promocodes-coupons/booking`, `/promocodes-coupons/digitalocean`, `/promocodes-coupons/drimsim`, and `/promocodes-coupons/timeweb`.
- `coupons-feedback` covers the Airbnb and Drimsim feedback forms.
- All routes also exist under `/en/promocodes-coupons`. English directory visibility and body translations differ by service.
- `/promocodes-coupons/firstvds` was removed on purpose because the FirstVDS referral rules forbid it. Require 404 for GET and POST.

## How to get to it (user POV)

- Click home `Промокоды и купоны` to `/promocodes-coupons`, or bookmark the directory or any service route.
- Directory `DigitalOcean` and Russian-only `Timeweb` are under `Веб-хостинг`. `Airbnb` and `Booking` are under `Жилье`. `Дримсим` is under `Сим-карты`.
- Trip articles can link to Airbnb coupons, including `/life/msk.2017.07`, `/life/osaka.2017.12`, and `/life/shanghai.2017`. Record the actual rendered href before following it.
- Drimsim's `отдельная страница` reaches `/news/271`. Airbnb's coupon table links to travel notes such as `/life/hamburg.2016` and `/life/amsterdam.2016`.
- Use footer `In English` and `По-русски` where shown. Russian Drimsim and Timeweb pages hide the language selector.

## Driving it with Safari MCP

Preconditions:

- Require the ready isolated instance and log mail. No account is required. Use a verification email, not production credentials.
- Referral links leave the site. Inspect their destinations without registering, booking, paying, or redeeming a coupon unless authorized separately.
- Confirm the isolated Telegram admin ID is unset before feedback. Log mail does not suppress Telegram notifications.
- `NewsSeeder` does not provide historical `/news/271`. Intended Drimsim-article proof fails without that content even when the news index redirect works.

1. Click the home directory link. Require `Промокоды и купоны` and the three groups. Click all five service links independently, return between actions, and require their matching service headings.
2. On Airbnb, require the `Купон` and `Где проверен` table, including `ALSACE2015` and its Hamburg note link. Follow a rendered local travel link and require that intended story, not a fallback page. Independently exercise a rendered trip-to-Airbnb entry.
3. Inspect Airbnb's `Получить скидку 2100 ₽` href `https://www.airbnb.ru/c/spankov1?s=8`. On English, require `Get $36 coupon` and `https://www.airbnb.com/c/spankov1?s=8`. Record the advertised offer, not a claim that the old coupon remains redeemable.
4. On Booking, require `Получить скидку 1000 ₽` and href `https://www.booking.com/s/34_6/f4544993`. In English require `Get €15 discount` with the same referral destination.
5. On DigitalOcean, require codes `DO10`, `DROPLET10`, `BITNAMI`, `ACTIVATE10`, `LOWENDBOX`, and `DOPRODUCT`. Inspect `Зарегистрируйтесь на сайте DigitalOcean` to `https://m.do.co/c/0864de50ab6c` without signing up or adding a payment method.
6. On Drimsim, require `Заказать симку с бонусом в 7 евро` and href `https://drimsim.app.link/3SdHuoxSLN`. Follow `отдельная страница` and require the intended `/news/271` article. Report the seeded missing-article failure separately from coupon rendering.
7. On Timeweb, require `Ознакомиться со всеми акциями` and href `https://timeweb.com/ru/services/bonuses/?i=19980`. Inspect `mailto:timeweb@ivacuum.ru` without opening mail. Do not expect an actual coupon-code table here.
8. On Airbnb and Drimsim, fill `Ваше имя`, `Электронная почта`, and `Текст сообщения`, then click `Отправить сообщение`. Use distinct text and allow the issue flood interval between forms.
9. Require the acceptance flash and cleared textarea. Confirm open `issues` rows with titles `Airbnb` and `Drimsim`, matching page paths, email, and text through read-only SQL. The title input is hidden. Leave `wire:model='mail'` empty.
10. Return to the directory and click `In English`. Require English grouping and no Timeweb directory entry. Exercise each offered service locale switch and direct English bookmark, including `/en/promocodes-coupons/timeweb` and `/en/promocodes-coupons/drimsim`.

## Gotchas

- Service titles include the current month and year. Match the service and current date instead of fixing a historical heading.
- Referral details come from `config/cfg.php`. If configuration differs in the run, record that configuration and actual href rather than silently following a different host.
- Feedback can create a guest user and sends an admin notification only when configured.
- Sources are `routes/web.php`, `CouponController`, the coupon views, `lang/{ru,en}/coupons.php`, `config/cfg.php`, and `FeedbackForm`.
