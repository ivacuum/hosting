# Games

Readers browse games the author tried or finished, open a game's description and dates, and read available thoughts and screenshots.

## Sub-features

- `games-catalog`: the catalog links to the correct game detail.
- `games-review`: details show title, release/completion dates, description, and available review.
- `games-layout`: screenshots retain their proportions and controls stay on the frame while images are pending and loaded.
- `games-home`: a home-page game card reaches the same game.
- `games-language`: the locale switch preserves game identity and changes metadata language.

## How to get to it (user POV)

- Bookmark `/games`; click a catalog card such as `Slay the Spire` (`/games/slay-the-spire`).
- Home `/` game cards and the games section's list link if rendered.
- Bookmark `/games/slay-the-spire`, or footer `In English` → `/en/games/slay-the-spire`.
- The `в Steam` / `on Steam` link is external, not another local app route.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready; the standard game seed includes `Slay the Spire`, release `2019-01-23`, completion `2022-10-22`, and bilingual descriptions.
- Public review screenshots on `life.ivacuum.org` and Steam-hosted artwork need actual availability for image proof; no local screenshot copy is required and fixtures must not be substituted.

- **Catalog.** Open `/games`, require heading `Игры`, intro text, and visible game cards. Click `Slay the Spire` by its `/games/slay-the-spire` href. If paginated off the current page, use visible pagination and record those actions rather than jumping directly to detail.
- **Detail.** Require `Slay the Spire`, release/completion date labels, `time[datetime='2019-01-23']`, `time[datetime='2022-10-22']`, and the Russian description beginning `Мы смешали жанры`. Its seeded review exists. Require `Мысли и скриншоты`, prose beginning `Невероятная игра`, and eight review screenshots. Save the initial state before scrolling so lazy-image layout remains observable.
- **Pending layout.** Before scrolling, use read-only Safari `evaluate_javascript` inspection to record screenshot frame dimensions and caption/link offsets. Require at least one genuinely pending image (`complete: false`), a reserved 16:9 frame, a caption at the frame's bottom, and a link at its top. If every image has already loaded, reopen the page and try once; otherwise report this state as `NOT_VERIFIED`. Do not change image loading or inject DOM state to force it.
- **Loaded layout.** Scroll through the review using real browser actions. Use read-only browser inspection to require all eight screenshots to have positive intrinsic dimensions, displayed proportions matching their intrinsic ratios, images filling their reserved frames, and correctly positioned captions and links. Separately require the hero image to load. Bound observation to 30 seconds after scrolling; pending images remain unverified, completed zero-width images fail. Save measurements and a rendered screenshot. Image bytes alone do not prove layout.
- **Home entry.** Return to `/`, select a rendered game card, record its title/href, and require matching detail. Open the same copied URL as a bookmark to exercise that entry independently. Separately return home and click the games section heading `Игры` with href `/games`; require the catalog heading and cards. Do not require the home-page sample to always include Slay the Spire.
- **Language.** On Slay the Spire, click `In English`; require the same slug under `/en/games/`, `html[lang='en']`, unchanged dates, and English description beginning `We fused card games and roguelikes`. Its authored review currently has Russian-only prose; English metadata success does not prove a translated review. Return through `По-русски` and require Russian metadata again.
- **External boundary.** Inspect the visible Steam link's href and language parameter without following it unless external navigation is explicitly in scope. Record that this does not prove Steam availability.

## Gotchas

- The catalog is paginated, and home-page selection is not a full catalog. Record what was actually rendered.
- A game without a review can legitimately omit `Мысли и скриншоты`; selecting a different game does not prove the intended review journey. Report missing review preconditions for that game.
- Artwork comes from Steam and review screenshots from public `life.ivacuum.org` URLs. Neither is guaranteed by metadata seeding; visual failures must remain visible in the report. A pending lazy image is not evidence of a missing file.
- Slay the Spire's Russian Steam link is `https://store.steampowered.com/app/646570?cc=KG&l=russian`; the English link has the same app ID without query parameters. Inspect these links without following them unless external navigation is in scope.
