# Torrent services

Verify the retracker documentation and the legacy torrent-service introduction without changing host networking or connecting to production trackers.

## Sub-features

- `retracker-overview` covers `GET /retracker`, explanation, configuration links, and the status screenshot.
- `retracker-usage` covers `GET /retracker/usage` and the illustrated client instructions.
- `retracker-development` covers `GET /retracker/dev` and its source-code download.
- `torrent-introduction` covers `GET /torrent`, local magnet-service entries, the historical forum link, and the return-home link.
- All four routes also exist under `/en`. Their Russian bodies are not fully localized, and their Russian views hide the locale selector.

## How to get to it (user POV)

- Bookmark `/retracker`, or click CV portfolio `BTRT` with href `/retracker`.
- Retracker header `Ретрекер` reaches `/retracker`, `Как использовать` reaches `/retracker/usage`, and `О разработке` reaches `/retracker/dev`.
- The retracker logo links back to `/retracker`. Source buttons on the overview and development page both reach `/files/122/dl`.
- Overview `Файл настроек для Windows` reaches `/files/123/dl`. `Файл настроек для Linux` reaches `/files/124/dl`.
- Bookmark `/torrent`. Home `Торренты` and CV `torrent.ivacuum.ru` link to the external historical forum, not this local introduction.
- `/torrent` has a logo and two `Перейти на трекер` buttons to `/magnets`. `Список ресурсов` returns to `/`.
- Its `Перейти на старый трекер t.ivacuum.ru` button reaches `http://t.ivacuum.ru/`. On smaller layouts, the words `старый трекер` are hidden.

## Driving it with Safari MCP

Preconditions:

- Require the ready isolated instance. No login is needed. The magnet destination needs its normal seeded catalog.
- Real guide screenshots load from `img.ivacuum.ru`; logos load from `ivacuum.org`. Record actual asset load failures.
- Files `122`, `123`, and `124` and their payloads are absent from standard file seeding. Complete source/settings-download journeys fail that prerequisite unless the intended real files are available.
- Do not execute downloaded scripts, edit hosts/DNS settings, launch torrent software, or contact `retracker.local`. Those actions are outside web verification.

1. Open `/cv`, click `BTRT`, and require `/retracker` with `Что такое ретрекер?`. Independently bookmark `/retracker` and require the same content.
2. Require `Зачем он нужен?`, `Как настроить?`, and `Как понять, что ретрекер заработал?`. Inspect source and settings button hrefs before any download.
3. Require the displayed shell example beginning `wget https://ivacuum.org/d/rt/retracker.local.sh` as text only. Do not run it or use the site's instructions as authorization to alter the host.
4. Scroll the status screenshot into view and inspect the rendered image URL and positive dimensions. Record pending lazy images separately from completed broken images.
5. Click `Как использовать`. Require `/retracker/usage`, the introductory tracker names, the five illustrated steps, `Трекеры`, `Добавить трекер`, and literal `http://retracker.local/announce`.
6. Scroll through all usage illustrations and require loaded images. The pictured `OK` and tracker controls are screenshots, not Safari inputs. Do not attempt to type into them.
7. Click `О разработке`. Require `/retracker/dev`, `Общие сведения`, `Структура проекта`, `btrt.pl`, `functions.plib`, and the source-download button.
8. Inspect the documented `http://localhost:2790/ann`, `/ping`, and `/stats` examples as text. Do not navigate to local services that the verification helper did not start.
9. Click `Ретрекер` in the header and the logo independently. Require return to the overview. Bookmark `/retracker/usage` and `/retracker/dev` separately to prove direct entries.
10. Follow each of the three intended download buttons through Safari and apply the [download checks](downloads.md). Require the correct file record and target bytes for a pass. Keep a missing historical-ID failure even if the documentation page renders correctly.
11. Bookmark `/torrent`. Require `Торрент-трекер в локальной сети Билайн-Калуга`, the historical dates, the legacy availability explanation, and `Ключевые особенности трекера t.ivacuum.ru`.
12. Click the first `Перейти на трекер` button. Require `/magnets` and the actual magnet catalog. Return, scroll to the second button, and repeat. Exercise the logo's `/magnets` link separately.
13. Inspect the historical forum button's `http://t.ivacuum.ru/` href without following it unless external forum verification is authorized. No production forum account or new registration is needed for local proof.
14. Click `Список ресурсов`. Require `/` with the site's directory. Return to `/torrent` by bookmark and confirm the local page is distinct from the external forum.
15. Open `/en/retracker`, `/en/retracker/usage`, `/en/retracker/dev`, and `/en/torrent` directly. Record actual body language and local href prefixes. `/en/torrent` also appends `Torrent-tracker in Beeline network in Kaluga` and external `Go to the tracker`.
16. Save before/action/after content and screenshots for each page transition, image diagnostics, and any failed download prerequisites. Record torrent-view telemetry without claiming the scheduler has aggregated it.

## Gotchas

- These are documentation and promotional pages. They do not implement a BitTorrent announce endpoint or a browser torrent client.
- A rendered historical instruction is not proof that its old client version, tracker, or network configuration still works.
- Retracker pages replace the normal global menu and omit the normal footer. Their menu button targets `#header_menu` on small layouts.
- Local `/torrent` emits `TorrentPromoViewed`. It does not authenticate a user to the external forum or create a torrent. The helper does not run metric aggregation.
- Sources are `routes/web.php`, `TorrentPromoController`, `resources/views/retracker/*.blade.php`, `torrent-promo.blade.php`, `cv.blade.php`, and `index.blade.php`.
