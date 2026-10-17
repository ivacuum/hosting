# News

Verify published news, article discussion, locale boundaries, the RSS feed, and legacy news bookmarks.

## Sub-features

- `news-index` covers `GET /news`, locale filtering, and pagination when enough published rows exist.
- `news-detail` covers `GET /news/{id}`, Markdown rendering, publication checks, and origin-locale redirects.
- `news-discussion` covers published comments and guest and signed-in comment submission on news details.
- `news-rss` covers `GET /news/rss`, its XML items, and article links with `?from=rss-title`.
- `news-legacy` covers `GET /news/{year}/{month}`, `/news/{year}/{month}/{day}`, and `/news/{year}/{month}/{day}/{slug}`.
- Each listed route also exists under `/en/news`. Unknown single-segment article IDs redirect to the current locale's index.

## How to get to it (user POV)

- Click header `Новости` with href `/news`. Russian mobile home also has a `Новости` section link.
- Click an article title on `/news`, or open a copied `/news/{id}` bookmark.
- Click `rss` beside the index heading. Feed readers can also discover the head's `rel='alternate'` link.
- Use footer `In English` on the index to `/en/news`. Article details deliberately hide the language selector.
- Follow article bookmarks from authored pages, including `/news/271` from travel tools and Drimsim coupons and `/news/263` from the Japanese trainer.
- Open historical date URLs directly. The legacy routes do not select an archive month or article anymore.
- On an article, use `#comments`, `#comment-add`, or a rendered `#comment-{id}` bookmark to reach discussion.

## Driving it with Safari MCP

Preconditions:

- Require the ready isolated instance. `NewsSeeder` creates ten published Russian posts, one published English post, and hidden `Hidden in the ocean`.
- Find real IDs with the run's read-only SQL helper. Do not assume a title has a production ID. `Markdown post` and `SpaceX` are stable seeded titles.
- For signed-in submission, use `guest@example.com` and verify `/my/profile`. Guest submission requires log mail and a valid email. Do not follow OAuth providers for local comment proof.
- Standard seeds do not provide a second Russian news page or the historical articles `263` and `271`. Report those missing prerequisites as failures for their intended journeys.

1. Click header `Новости`. Require the index heading, `rss`, published Russian titles, dates, author `news`, and no hidden or English-only title.
2. Click `Markdown post` by its extracted article href. Require the same title, `Heading 1`, bold and italic text, quote, list, and code block in the body. Inspect the external `https://example.com` link without following it.
3. Reopen that article bookmark independently. Require identical article identity, the date, author, `Обсуждение`, and `#comment-add`. Record view telemetry separately from content proof. The helper does not run metric aggregation.
4. If a second page is present, click the visible `a#next_page[rel='next']` with href `/news?page=2`. Require different articles in descending date order. Return with `a#prev_page[rel='prev']`. With the default ten Russian rows, record the absent pagination prerequisite rather than fabricate a successful next-page drive.
5. Return to the index and click `In English`. Require `/en/news`, `html[lang='en']`, and `Rediscovering the World: Travelers Reveal the Joy of Exploration`, without the Russian feed titles.
6. Open `/en/news/{RussianId}` and `/news/{EnglishId}`. Require 301 redirects to the article's own locale and the correct article body. Open the hidden ID and require 404. Open a confirmed nonexistent ID and require a 301 to `/news`, not an invented article.
7. Click `rss` on each locale's index. Record `Content-Type: application/xml`, RSS channel title/link, matching-language items, publication dates, and absence of the hidden title. Safari may offer a feed application instead of rendering XML. Capture network response evidence without claiming a rendered article.
8. Follow an RSS item's title URL into the local article. Require its ID and `?from=rss-title`, then its corresponding body. Keep feed inspection separate from browser navigation proof.
9. Open `/news/2004/01`, `/news/2004/01/02`, and `/news/2004/01/02/example` independently. Require 301 redirects to `/news`. Repeat with `/en/news/` and require `/en/news`.
10. As a guest, enter a valid email in `#comment-add input[wire\:model='email']` and a unique sentence in `textarea[wire\:model='text']`. Leave `input[name='mail']` empty. Click `Отправить`.
11. Require the pending-activation flash, a cleared textarea, and no published display of the new guest comment. Read the run's `comments` row and log mail. Require pending status and the news relation. Do not confuse mail generation with delivery.
12. Signed in as the seeded normal user, add a different sentence through the same form. Require the new text and author in `Обсуждение`, then reload and require persistence. Confirm the published row and news relation with read-only SQL.
13. Submit an empty form and require native validation without a new comment. Save before/action/after evidence and network diagnostics for any failed reactive submission.

## Gotchas

- The news index hides full article bodies below the `sm` breakpoint. A visible title is not proof that the body rendered on mobile.
- Index views use `news-views-observer.js` and batched beacons. Detail views emit `NewsViewed` on the backend. Do not require immediate aggregated database counts.
- Comment confirmation is an authenticated mail-link journey. Preserve its log-mail URL for the account/comment-confirmation verifier instead of claiming activation from a pending flash.
- Public news has no edit or delete controls. Administrative news editing is separate scope.
- Sources are `NewsController`, `NewsBcController`, `NewsRssController`, `NewsShowForm`, `NewsSeeder`, `NewsFactory`, `News`, the news views, `Comments`, `CommentAddForm`, and their views.
