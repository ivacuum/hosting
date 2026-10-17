# Concert stories

Readers browse attended and upcoming concerts, open a published concert account, and discover other concerts for the same artist.

## Sub-features

- `concert-list`: grouped concerts show artist names and dates.
- `concert-read`: a published concert opens its story and media.
- `concert-timeline`: related artist entries navigate to another concert.
- `concert-rss`: the concert RSS link opens a feed.

## How to get to it (user POV)

- `/life` → `Концерты` in `Избранное` → `/life/gigs`.
- Concert entries in `/life` year groups, or a bookmarked published concert story URL.
- `rss` next to the heading on `/life/gigs` → `/life/gigs/rss`.
- English list `/en/life/gigs` and the footer locale switch on a story.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready; the seeded concert list includes a clickable published concert. Genuine public media on `life.ivacuum.org` must load for image proof; it is not supplied through local uploads.

- **List.** Open `/life`, click `Концерты` with href `/life/gigs`, and require `Посещенные и ожидаемые концерты`, year groups, artist names, and dates. Capture the before link and after listing.
- **Story.** Click a visible artist link inside the concert list; record its exact href and label. Require the matching concert title, date/context, prose, and loaded media. Save screenshot/text and the route. Independently follow a concert entry in `/life` and a bookmark of that same href.
- **Timeline.** In the story's artist timeline, click another linked concert and require a changed route and corresponding concert details. Record both titles. If no second published concert exists for that artist, report failed precondition for `concert-timeline`.
- **Locale.** Use footer `In English` and `По-русски`; require the same story and the expected page language, with actual translated prose where provided.
- **RSS.** Return to `/life/gigs`, click its `rss` link, and save the feed response. Require valid XML entries and local story links. A browser XML viewer is not a failure; an HTML exception is.

## Gotchas

- Unpublished concerts are plain artist text, not broken links. Select an actual anchor for the reading journey.
- Concert story hrefs come from the list and use the site's `/life/{slug}` dispatch; do not invent `/life/gigs/{id}`.
- As with travel notes, public `life.ivacuum.org` image URLs are independent of local uploads. Trigger lazy loading and inspect actual dimensions before reporting image failures; do not manufacture a replacement screenshot asset.
