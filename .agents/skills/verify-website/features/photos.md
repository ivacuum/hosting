# Photos

Readers discover published photos through trips, tags, cities, countries, or a map, open an image, navigate adjacent images, and return to its story.

## Sub-features

- `photo-discover`: discovery facets lead to their filtered published photos.
- `photo-view`: a thumbnail opens the real full-size image with story/date/geotags.
- `photo-navigation`: click and arrow-key navigation retain the active filter.
- `photo-story`: the story link opens the parent note at the image anchor.

## How to get to it (user POV)

- Header/mobile `Фотки` opens `/photos/trips`; `Новые` opens `/photos`.
- Photo tabs: `/photos/trips`, `/photos/tags`, `/photos/map`, `/photos/cities`, `/photos/countries`, and `/photos/faq`.
- A facet's visible link leads to its filtered gallery, then a thumbnail links to `/photos/{photo ID}` with relevant filter parameters.
- A bookmark of a visible photo URL is a separate entry. English equivalents use `/en/photos`.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready. The seed includes Moscow, Osaka, and Suwon photo metadata, with `screenshot` and `local writing` tags. Photo URLs point at public `life.ivacuum.org` originals and resized variants, not disposable local uploads. Require actual loaded image dimensions; record failed or pending remote resources without treating an empty local directory as proof of failure.
- A chosen filtered gallery must have at least two published photos for navigation. Map verification additionally requires published geotagged photos and access to the map's external resources.

- **Discovery.** Click header `Фотки`, require `/photos/trips`, then separately exercise `Новые`, `Поездки`, `Тэги`, `Города`, and `Страны` by their tab hrefs. Open a visible facet link and record its URL/count. Require corresponding thumbnails, not just a page heading. Exercise `Карта` separately: a marker balloon links to the parent story with an `#IMG_…` anchor, not to `/photos/{id}`. From a photo detail, the map-marker icon next to `Геотэги` opens `/photos/map?lat=&lon=&zoom=16`. Seeded coordinates are random, so markers appear at arbitrary places. Record missing map preconditions as failures.
- **Open.** Click a thumbnail in a chosen gallery; record the source href and filter query. Require `.photo-show-img` to display the real image, plus `История`, `Дата снимка`, and `Геотэги`. Save screenshot/text and image network diagnostics. For a read-only image check, `evaluate_javascript` can return `Array.from(document.querySelectorAll('.photo-show-img')).map(img => ({src: img.currentSrc, loaded: img.complete && img.naturalWidth > 0}))`.
- **Navigate.** Read fresh content/HTML to identify the actual `#next_page` and `#prev_page` anchors, click each available direction, and require a different image URL/metadata while retaining the facet parameters. Repeat with `keyPress` values `ArrowRight` and `ArrowLeft` outside inputs. Wait for Livewire navigation and re-extract; never invoke Livewire internally.
- **Story and bookmark.** Click the named story link beside `История`, require its parent note URL and `#IMG_...` anchor, and confirm the corresponding image. Independently open the copied photo URL as a bookmark. Capture both transitions.
- **Locale.** Use footer `In English`; require `/en/photos/...`, the same photo identity, and translated UI labels. Treat this separately from Russian navigation.

## Gotchas

- Some image links have no accessible name. Identify them by their real href/image content using HTML extraction, not screen coordinates.
- `#prev_page` is the left overlay, `#next_page` the right overlay; their model variable names are inverted. Use rendered hrefs as truth.
- Filter parameters (`trip_id`, `tag_id`, `city_id`, `country_id`) are part of navigation correctness. A generic adjacent photo is not enough.
- Remote image availability must be observed. Completed zero-width images fail visual proof; lazy/pending images remain unverified until actually loaded. Adding fake placeholder media would weaken the contract.
- Photo map, reactive navigation, story anchoring, and each facet are distinct entry points; one opened thumbnail proves none of the others.
