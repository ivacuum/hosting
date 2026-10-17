# Travel notes

Readers discover travel stories by year, city, country, or calendar, open published notes, move between related stories, and choose Russian or English text.

## Sub-features

- `travel-discover`: year, country, city, and calendar entry paths reach the expected notes.
- `travel-read`: a published story renders its title, prose, and photographs.
- `travel-language`: footer switches locale while retaining the story.
- `travel-rss`: the visible RSS entry returns a usable feed.

## How to get to it (user POV)

- Header/mobile `Заметки` opens `/life`; home-page travel cards open individual stories.
- The notes subnav exposes `/life/countries`, `/life/cities`, `/life/calendar`, and `/life` (`По годам`). Country links lead to `/life/countries/{country slug}`; city/story links use the actual href in the page.
- A bookmarked published `/life/{slug}` story is another entry; seeded example `/life/berlin.2017.05` has explicit Russian and English descriptions.
- `rss` next to `Поездки` opens `/life/rss`. Footer `In English` opens the same path under `/en`.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready and the seed contains published stories. Full visual proof requires successful browser loading of the story's genuine public images on `life.ivacuum.org`; local uploads are not the source for these story URLs.

- **Year entry.** Open `/`, click the visible `Заметки` link to `/life`, and require heading `Поездки`, year groups, and story links. Capture the clicked link and resulting listing.
- **Facets.** From `/life`, independently click `По странам`, `По городам`, and `Календарь` using hrefs `/life/countries`, `/life/cities`, `/life/calendar`. For countries, open a visible country then a published story. For cities, open a city then a published story; a city with one published story can redirect directly. For the calendar, follow its visible story link. Record each path separately and require the selected story's title and matching URL.
- **Read.** Open the actual published Berlin story link if listed, or another explicitly recorded published story. Require article prose, title, correct locale, and successful loaded story images; capture text, screenshot, and failed-image/network diagnostics. Exercise visible previous/next story links if present and require a different matching title/URL.
- **Home and bookmark.** Independently click a home-page travel card and navigate to its copied story URL as a bookmark. Verify both reach the same article; do not count direct navigation as the card click.
- **Language.** On a story, click footer `In English`, require the same slug under `/en/life/` and `html[lang='en']`; capture English prose and return through `По-русски`. Report unavailable translation rather than treating Russian fallback as translated content.
- **RSS.** From `/life`, click `rss` with href `/life/rss`. Save the HTTP response/network body and require XML feed entries linking to published stories, not an HTML error page. Repeat `/en/life/rss` when localized feeds are in scope.

## Gotchas

- The seed marks the newest generated trips inactive/hidden; do not require every seeded row to be publicly listed. Generated dates can change the order.
- The seed creates metadata, while stories reference real public media on `life.ivacuum.org`. Scroll lazy images into view before assessing load state. Completed zero-width images fail `travel-read` visual proof; pending images remain unverified. Empty local uploads alone are not an image failure, and text-only navigation success must be reported separately.
- City links are not a guessed `/life/cities/{slug}` route. Follow the rendered href, which can share `/life/{slug}` handling.
- Calendar links may depend on generated dates. Record the visible year/month before interacting; if no published story is reachable, report that failed precondition rather than silently switching to the year list.
