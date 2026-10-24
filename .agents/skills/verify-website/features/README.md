# Hosting verification map

This is the verification source for the whole Hosting website. It covers public pages, account and traveler pages, administration, shared browser controls, machine endpoints, and supporting assets. Read the matching recipe before driving. A mapped entry point is not a claim that the journey has passed.

## Verification scope

The feature guides are browser checklists, not an exhaustive route inventory. When route details matter, inspect the current application with `AI_AGENT=1 php artisan route:list --no-interaction` rather than maintaining a duplicate catalog.

Dynamic story slugs, songs, database records, pagination, query filters, and responsive controls must be discovered and driven through the relevant recipe. Static assets loaded from a build are checked through the real browser, not enumerated by hashed filename. Artisan maintenance commands and external websites are dependencies, not local website pages.

## Baseline preconditions

- Launch a new instance following [SKILL.md](../SKILL.md). Use its exact manifest URL, not the shared development domain.
- Require doctor success after migrations, full seed, and frontend build. Start anonymous in a new Safari tab unless the journey requires login.
- Normal account is `guest@example.com` with password `top-secret`. Administrative account is `root@example.com` with the same disposable password. Never delete or repurpose root ID 1.
- Generated dates, statuses, and IDs can vary. Select actual published links and record IDs, not unrestricted first rows. Routes and empty forms do not establish that a scenario's fixtures exist.
- The helper isolates database, Redis, files, logs, sessions, and cookies. It does not isolate all outbound network requests. Public media, maps, video, OAuth, Telegram, referrals, and publishing have separate boundaries.
- Story/photo/game-review media comes from `life.ivacuum.org`. Steam artwork comes from `shared.fastly.steamstatic.com`. Inspect actual loaded dimensions and layout before and after lazy loading. Empty local uploads alone do not establish a media failure.
- Browser file selection, native protocol handlers, an enabled development toolbar, tracked mail, local integration secrets, and external test accounts are explicit prerequisites where required. Missing prerequisites are failed or not-verified journeys with reasons, never substituted passes.

## Driving and proof

- Use Safari MCP through `tools.safari` in OpenCode `execute`, or `mcp__safari__*` in Claude Code. See SKILL.md for native select and modifier-key limits. Extract fresh UIDs, then use real click, typing, selection, and key actions. Selectors in the recipes identify controls; they do not authorize internal Livewire setters.
- Use HTTP clients for machine endpoints, redirects, status/header evidence, and supplemental checks. HTTP form submission is not browser proof of a form workflow.
- Reset navigation and authentication for each entry point. Record Russian, English, desktop, mobile, keyboard, bookmark, and menu paths separately when they are in scope.
- Capture the action and resulting state, readable text, screenshot, relevant status/network data, and independent SQL/file/mail evidence under `evidence/FEATURE/`.
- Record each sub-feature and entry point as `PASS`, `FAIL`, or `NOT_VERIFIED`, with evidence and a reason. A broad run must report missing fixtures and known broken paths as well as successful paths. A representative smoke run cannot certify the whole index.
- Delete or batch-mutate only verification-owned records inside the disposable stack. Source-template generation and thumbnail cleanup must stay inside its copied app. Never use a recipe to mutate production or shared development state.
- Do not use real external credentials, send messages, publish content, accept offers, or open native handlers without approval for that external test. Log mail proves generation only. Registration of a callback or transport route does not prove its successful business flow.
- Keep entry points and user-facing steps in the relevant feature guide.

## Public content

- [Site pages](site-pages.md) covers home, about, résumé, privacy, and primary navigation.
- [Travel notes](travel-notes.md) covers year, country, city, calendar, stories, and RSS.
- [Concert stories](concerts.md) covers concert listings, stories, artist timelines, and RSS.
- [Life reference pages](life-extras.md) covers books, languages, favorites, laundry, movies, podcasts, and travel equipment.
- [Photos](photos.md) covers discovery facets, map, full images, adjacent navigation, and story anchors.
- [Games](games.md) covers catalog, reviews, dates, localization, home cards, and pending/loaded image layout.
- [News](news.md) covers articles, comments, RSS, and historical redirects.
- [Downloads](downloads.md) covers file listings, download responses, and download accounting.
- [Documentation](documentation.md) covers help and hosting articles, sidebar navigation, and contents links.
- [DC++ guides and hubs](dc-guides.md) covers clients, installation guides, FAQs, hub links, and click accounting.
- [Coupons and referrals](coupons.md) covers every provider page, referral boundaries, and the FirstVDS request form.
- [Torrent and retracker information](torrent-services.md) covers torrent promotion and retracker documentation.

## Interactive features

- [Developer tools](developer-tools.md) covers Base64, hashes, JSON, EXIF, and map polygons.
- [Japanese and WaniKani](japanese.md) covers kana, word training, search, levels, characters, vocabulary, and learned-state controls.
- [Korean and PSY](korean.md) covers Hangul training and song/video pages.
- [Number trainer](number-trainer.md) covers language/voice selection, practice, speech, and synopsis.
- [Magnets](magnets.md) covers search, detail, submission, personal entries, chat, requests, and download actions.
- [Feedback and comments](feedback-comments.md) covers contextual feedback, discussion forms, confirmation, and typo reports.
- [Gallery](gallery.md) covers authenticated browsing, upload, thumbnails, full images, and selection limitations.

## Accounts and travelers

- [Authentication](authentication.md) covers registration, confirmation, password recovery, OAuth, and the password-change discovery URL.
- [Account profile](account-profile.md) covers password login/logout, profile persistence, public identity, and avatar actions.
- [Account settings](account-settings.md) covers account home, password, preferences, and Telegram linking.
- [Personal trips](personal-trips.md) covers owned trip creation, edits, deletion boundaries, and access control.
- [Public travelers](travelers.md) covers the user directory, numeric profiles, traveler homes, and travel/city/country/detail pages.
- [Mail archive](mail-archive.md) covers tracked message viewing, link redirects, and reporting.

## Administration

- [Content administration](admin-content.md) covers artists, cities, countries, hubs, files, concerts, news, photos, social posts, tags, and trips.
- [Moderation](admin-moderation.md) covers chat, comments, gallery images, issues, magnets, and batch/open/close actions.
- [Users and identities](admin-users.md) covers users, external identities, stored email, and guarded deletion.
- [Admin tools](admin-tools.md) covers the admin home, template previews, SVG, thumbnails, metrics, and redirects.

## Shared controls and supporting endpoints

- [Shared interactions](shared-interactions.md) covers header/bottom navigation, breadcrumbs, pagination, keyboard reading/search/locale controls, notices, and embedded videos.
- [Integrations](integrations.md) covers browser beacons, image resize, Instagram, Telegram, and the local MCP Tag Server.
- [Runtime support](runtime-support.md) covers readiness, client IP, errors, manifests, service-worker limitations, icons, Livewire endpoints, Boost, and Debugbar.

## Known prerequisites and broken paths

Each feature's `Gotchas` records its source findings and runtime limits. In particular, confirmation tokens, tracked mail, genuine downloadable file payloads, historical news IDs, browser upload support, and external-service fixtures are not guaranteed by the default seed. Missing handlers or links with no registered route remain failed paths in the map. Do not silently remove them from a journey or fix unrelated application behavior while updating documentation.
