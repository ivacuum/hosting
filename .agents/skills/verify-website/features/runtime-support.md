# Runtime, static assets, and development support

Visitors receive the site's scripts, manifests, icons, and error pages. Operators can check HTTP readiness and client-address output. Development tools add supporting routes that are not production features.

## Sub-features

- `runtime-readiness` distinguishes an HTTP response from a usable seeded app.
- `runtime-errors` renders explicit error pages with matching status codes.
- `runtime-static` serves manifests, icons, crawler files, and the service-worker scripts.
- `runtime-livewire` loads frontend assets and handles normal reactive updates/uploads.
- `runtime-development` identifies Boost and Debugbar routes without treating them as public product pages.

## How to get to it (user POV)

- Readiness is `/health-up`; client-address JSON is `/ip`.
- Explicit error pages are `/401`, `/403`, `/404`, `/500`, and `/503`. An unknown URL is a separate natural 404 entry.
- The base page links `pwa-manifest-ru.json` or `pwa-manifest-en.json`, icons, assets, and `/service-worker-installer.js`.
- Root static files are `/robots.txt`, `/ads.txt`, `/favicon.ico`, `/apple-touch-icon.png`, `/apple-touch-icon-144x144.png`, `/apple-touch-icon-precomposed.png`, both manifests, and both service-worker scripts.
- Livewire injects a generated `livewire-…` prefix for its JS, maps, component CSS/JS, update, upload-file, and preview-file endpoints. Read the actual loaded URL instead of hardcoding the generated hash.
- Local development also registers `POST /_boost/browser-logs` and Debugbar assets, cache deletion, query explain, open, and clockwork routes.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready. These checks do not authorize clearing another instance's cache or changing a global browser profile.
- Reactive and upload journeys require their host feature's data and authentication. Debugbar is disabled in the baseline helper; enabled-Debugbar journeys have an unmet prerequisite there.

- **Health.** Open `/health-up` and save status/body. Require the expected rendered response, then run doctor and open `/life` before calling the instance usable. The HTML health response alone does not prove database seeding or feature availability. Check `/en/health-up` separately if it appears in the current route inventory.
- **Client address.** Request `/ip`, require JSON keys `ip` and `country`, and compare the IP with the actual local request. `country` can be null without proxy geolocation headers; do not invent a country fixture.
- **Errors.** Open each explicit error page and require the matching HTTP status and readable site error content. Open a genuinely nonexistent local path and require a natural `404` without internal exception details. Save the status as well as the screenshot; an error-shaped page with status `200` fails.
- **Manifests and icons.** Fetch each listed root static file and preserve its status/content type. Parse the two manifests, require their `ru-RU` and `en-US` languages, app name, icons, and locale-specific start URLs. Open those start URLs in the owned browser tab and require the corresponding local home page. Manifest icon URLs currently point to the public site, so successful local files do not prove those external URLs loaded.
- **Service worker.** Inspect the served installer and worker plus recent console errors. The installer registers only on HTTPS or hostname `localhost`; the helper uses `127.0.0.1`, so registration is intentionally skipped by that code. The worker is currently empty and provides no offline cache. Do not claim offline behavior or installation proof from a successful file request.
- **Livewire assets.** Drive an actual reactive form from its feature map. Require its generated JS and used component assets to load, then capture the real POST update and visible response. Use the actual upload-file and preview-file requests from gallery/avatar/EXIF workflows when the browser supports file selection. A guessed filename, source-map route, or unused component asset may legitimately be unavailable and is not a substitute for the real host journey.
- **Browser logs.** If Boost browser logging is active, capture a naturally generated local browser log request and the corresponding run log entry. Do not inject an application error just to create evidence. Absence of log events does not prove delivery through this route.
- **Debugbar.** With an explicitly enabled disposable Debugbar configuration, use its actual UI to load `/_debugbar/assets`, open a captured request through `/_debugbar/open` or `/_debugbar/clockwork/{id}`, and inspect a captured query before any explain action. Cache deletion and `POST /_debugbar/queries/explain` are development-only mutation boundaries. Never run them against the shared site. With baseline Debugbar disabled, record the UI journey as not verified instead of calling a manually requested route success.

## Gotchas

- The host feature guides describe dynamic content families and their record-discovery paths; registered routes alone do not enumerate story slugs, record IDs, built assets, or screenshot URLs.
- Static-file existence is not HTTP or image-rendering proof. Capture the real server response when those resources are in scope.
- Component CSS/JS, source maps, and temporary file previews require a real referenced component or temporary upload. Registered parameterized routes do not guarantee arbitrary parameter values work.
- Registration of development endpoints is not a claim that they are enabled or reachable in production.
