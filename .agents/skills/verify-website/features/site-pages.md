# Site pages

Verify the home-page directory, project description, standalone CV, and privacy information through their real reader entry points.

## Sub-features

- `site-home` covers `GET /`, its section links, travel covers, and game cards.
- `site-about` covers `GET /about` and the bilingual project description.
- `site-cv` covers `GET /cv`, its standalone layout, contact links, and portfolio links.
- `site-privacy` covers `GET /privacy-policy` and its two contact-form links.
- `site-locale` covers `/en/`, `/en/about`, and `/en/privacy-policy`. `cv` belongs to `routes/simple.php`, not the locale-prefixed web routes.

## How to get to it (user POV)

- Bookmark `/`, or click the header brand `vacuum kaluga` from a normal site page.
- Home links include `Заметки` and `Истории о путешествиях` to `/life`, `Игры` to `/games`, and `Промокоды и купоны` to `/promocodes-coupons`.
- Home also links to `/trainers`, `/japanese`, and, in Russian, `/korean`. Desktop Russian entries include `/magnets`, `/gallery`, and external `http://t.ivacuum.ru`.
- Desktop `ArtFly.DC++` reaches `/dc`. The Russian mobile home section `Новости` reaches `/news`.
- Bookmark `/about` or `/cv`. The inspected shared navigation does not provide a link to either page.
- Click footer `Конфиденциальность` to `/privacy-policy` on a Russian page. Click `форму обратной связи` there to `/contact`.
- Use footer `In English` and `По-русски` where rendered. `/cv` has neither the shared footer nor a locale-switch control.

## Driving it with Safari MCP

Preconditions:

- Use the ready isolated instance and a new Safari tab. No account is required for these pages.
- Home requires published trips with covers and seeded games. CV and home images require real remote media availability.
- Keep outbound contact, social, repository, and forum links unopened unless that external navigation is explicitly in scope.

1. Open `/`. Extract fresh page content with URLs and save a screenshot. Require the brand, the section links above, travel cards, and game cards.
2. Click the visible `/life`, `/games`, `/promocodes-coupons`, `/trainers`, `/japanese`, and Russian `/korean` section links separately, returning home between actions. Require each matching destination, not merely a changed URL.
3. On desktop, exercise `ArtFly.DC++`, `/magnets`, and `/gallery`. Require the DC page, magnet catalog, and guest sign-in redirect respectively. Record `Торренты` as an external forum entry, not a local `/torrent` link.
4. Click one travel cover and one game card. Record their titles and hrefs before clicking, and require the corresponding story or game detail. Do not assume the home sample always contains a particular item.
5. Return through the brand. Require `/` and the directory again. At a mobile layout, separately exercise the visible `Новости` home link. Do not change shared Safari settings to force a layout.
6. Bookmark `/about`. Require `О проекте`, the personal-site introduction, Laravel version text, and the GitHub source link `https://github.com/ivacuum/hosting`.
7. Click `In English`. Require `/en/about`, `html[lang='en']`, `About`, and the English introduction. Return through `По-русски`. Repeat the locale round trip on home and require translated section text and matching card identity.
8. Bookmark `/cv`. Require `Сергей Панков`, the developer role, `Образование`, `Опыт работы`, `Контактная информация`, and `Проекты`. Inspect `tel:+79105141181`, `mailto:me@ivacuum.ru`, and the remote portrait's load state without activating phone or mail handlers.
9. Click the CV's `vacuum.name` link with href `/`. Require home. Return to CV and separately exercise portfolio links `/life`, `/photos/map`, `/japanese`, `/retracker`, `/gallery`, `/dc`, and `/files`, recording the real destination and guest access boundary.
10. On a Russian shared-footer page, click `Конфиденциальность`. Require `Политика конфиденциальности`, `Как удалить свою учетную запись`, and update date `2022-03-28`.
11. Click each privacy contact link independently. Require `/contact` and its feedback form. Do not send an account-deletion request as verification.
12. Bookmark `/en/privacy-policy`. Require the `Privacy Policy` heading and record the Russian body as authored. This is not a fully translated policy. Save before/action/after evidence for each entry exercised.

## Gotchas

- Missing home cards fail their seeded prerequisites. An otherwise rendered home page does not prove those links or images.
- `/en/cv` is not registered. Do not invent an English CV route because its template contains English branches.
- Home hides several directory entries on small screens and in English. Direct navigation does not prove a hidden menu entry works.
- These informational pages have no content-save operation. Navigation may still emit normal site telemetry.
- Sources are `routes/web.php`, `routes/simple.php`, `bootstrap/app.php`, `HomeController`, and `resources/views/{index,about,cv,privacy-policy,base}.blade.php` plus `tpl/header-navbar.blade.php`.
