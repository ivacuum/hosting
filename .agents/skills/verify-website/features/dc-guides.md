# DC guides

Verify the DC++ encyclopedia, client downloads, installation guides, and counted hub links through their real navigation controls.

## Sub-features

- `dc-overview` covers `GET /dc` and `GET /dc/clients`.
- `dc-clients` covers `GET /dc/airdc`, `/dc/apexdc`, `/dc/dcpp`, `/dc/flylinkdc`, `/dc/greylinkdc`, `/dc/jucydc`, `/dc/kalugadc`, `/dc/pelinkdc`, `/dc/shakespeer`, and `/dc/strongdc`.
- `dc-help` covers `GET /dc/faq`, `/dc/rus_setup`, and `/dc/strongdc_install`.
- `dc-hubs` covers `GET /dc/hubs` and browser-triggered `POST /dc/hubs/{hub}/click`.
- `dc-feedback` covers the embedded feedback form on client pages and hubs.
- Every route above also exists under `/en/dc`. Russian-only content and menu visibility vary by view.

## How to get to it (user POV)

- Click desktop home `ArtFly.DC++` or CV `dc.ivacuum.ru` to `/dc`, or bookmark any route above.
- DC header `О DC++` returns to `/dc`, `Вопросы и ответы` reaches `/dc/faq`, and `Хабы` reaches `/dc/hubs`.
- Desktop header `Клиенты` opens a client dropdown. Mobile `Клиенты DC++` reaches `/dc/clients` after opening the menu button targeting `#header_menu`.
- The overview's client list and `/dc/clients` provide the same ten client destinations. `Kaluga DC++` is listed only in Russian.
- `Инструкция по русификации` on ApexDC++ and GreyLinkDC++ reaches `/dc/rus_setup`. FAQ also links there.
- StrongDC++ `Инструкция по установке` reaches `/dc/strongdc_install`. The guide links back to `/dc/strongdc`.
- Client pages' `Список популярных DC++ хабов` reaches `/dc/hubs`. Hub addresses are `dchub://` links, not ordinary local pages.
- Header `In English` and `По-русски` switch locale where offered. The desktop dropdown's literal `/dc/...` hrefs can return an English reader to Russian.

## Driving it with Safari MCP

Preconditions:

- Require the ready isolated instance. No account is needed. `DcppHubSeeder` creates three published hubs with random addresses.
- Client download IDs are historical and absent from `FileSeeder`. Real matching file records and payloads are required for complete download proof. Report missing prerequisites as failures.
- Screenshots use `img.ivacuum.ru`. A DC protocol handler and reachable external hub are separate prerequisites for connection proof.
- Before feedback submission, confirm the isolated Telegram admin ID is unset. `IssueReportedNotification` otherwise sends to Telegram even with log mail enabled.

1. Enter `/dc` from home and CV independently. Require the overview and client links. Open `/dc/clients` through the mobile menu when that layout is available and require the same client list.
2. On desktop, open `Клиенты` and click each client. Separately exercise each overview/list link and bookmark. Require the matching client name, version, `О программе`, download controls, and hub recommendation.
3. Check these exact download destinations. Each number denotes `/files/{id}/dl` with the current locale prefix where generated.
   - AirDC++ `3.41` uses `156`, with earlier versions `142` and `131`.
   - ApexDC++ `1.6.4` has 32-Bit `154` and 64-Bit `155`, earlier `141` and `137`, and Russian-language file `157`.
   - DC++ `0.782` uses `143`, with earlier `110`. FlyLinkDC++ `r504` uses `153`, with earlier `140`.
   - GreyLinkDC++ `0.49` has 32-Bit `145`, 64-Bit `146`, and Russian-language file `28`.
   - Jucy DC++ `0.85` has Windows `49` and `50`, Linux `74` and `148`, and macOS `51` and `147`.
   - Kaluga DC++ uses `12`. PeLinkDC++ `5.95` uses `78`, with earlier `65`. ShakesPeer `0.9.2` uses `33`.
   - StrongDC++ `2.42` has 32-Bit `132`, 64-Bit `134`, and earlier `98` and `100`.
4. On Jucy, record the initially visible OS group. Click `Показать клиенты для всех ОС`. Require all Windows, Linux, and macOS groups and six download links, with the show button hidden afterward. Repeat the visible English control `Show clients for other OSes` separately.
5. On clients with screenshots, scroll images into view and require actual loaded dimensions. Click a screenshot thumbnail and require its full-image destination or viewer, then return. Inspect `Официальный сайт` hrefs without claiming the external client still works.
6. Click both Russian-language guide entries and StrongDC++'s installation entry. Require `Инструкция по русификации` with `Russian.xml`, and `Инструкция по установке и настройке StrongDC++` with installation and configuration sections. Inspect their respective `157`, `28`, `132`, and `134` download links.
7. On `/dc/faq`, click summary `Если при входе на хаб вам пишется: Turn On your tags!!`. Require the answer about `Эмуляцию DC++`. Close it and require the answer to collapse. Open `Как скачивать файлы?` by keyboard and require its file-list explanation.
8. Click the shared-template hub recommendation and header `Хабы` separately. Require `Популярные DC++ хабы`, three published addresses ordered by title, and no requirement that the seeded hubs be online.
9. Record one hub's ID and `clicks` from `dcpp_hubs` with the run's SQL helper. Match its `a.js-dcpp-hub` href and `data-action='/dc/hubs/{id}/click'`.
10. If a protocol handler can launch an external client, stop at its prompt unless connection testing is authorized. Click the hub link through Safari and capture the local POST response. Require 204 and one counter increment even if Safari cannot open `dchub://`.
11. Click the same hub again without reloading. Require no second POST or increment. Reload `/dc/hubs`, click again, and require a new increment. The JavaScript deduplicates only the current DOM link, not the session.
12. On hubs, enter `Электронная почта` and a unique two-word-or-longer `Текст сообщения`. Click `Отправить сообщение`. Require the acceptance flash and cleared text. Use read-only SQL to confirm an open issue with title `DC++ Hubs`, page `/dc/hubs`, and submitted email/text.
13. On a client page, also fill `Ваше имя`. The title is hidden and fixed as `DC++ Client`. Submit through the visible form and require the same flash and a separate persisted issue with the client page path. Respect the issue flood interval between submissions.
14. Exercise each available locale switch and record actual content, href prefixes, and active navigation. Russian FAQ, localization, installation, and Kaluga pages suppress the Russian-to-English switch. Their direct English routes still need independent checks.
15. For each intended download, follow the browser link and apply the [download checks](downloads.md). Retain missing historical-record failures. Save action, rendered state, POST diagnostics, issue rows, and counter evidence separately.

## Gotchas

- Feedback inputs use `wire:model='name'` and `wire:model='email'` without HTML `name` attributes. The textarea has `name='text'`. Keep the hidden `wire:model='mail'` field empty.
- Hub feedback hides both name and title. Client feedback hides only title. Guest feedback can create an account for its email, but does not log the guest in.
- A 204 click response proves accounting, not hub availability or a completed file transfer. Do not run DC clients or installer binaries to prove a web guide.
- FAQ uses native `details` and `summary`. Screenshots of desktop client windows are static images, not browser form controls.
- Sources are `routes/web.php`, every `resources/views/dcpp/` page, `accordion.blade.php`, `DcppHubController`, `DcppHubClickController`, `DcppHub`, `DcppHubSeeder`, `resources/js/events.js`, `FeedbackForm`, and the Telegram notification/channel.
