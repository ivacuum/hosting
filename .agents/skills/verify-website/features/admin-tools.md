# Admin tools

Verify the ACP entry page, developer previews, SVG catalog, thumbnail conversion, and recorded metrics while distinguishing read-only pages from source and file writes.

## Sub-features

- `admin-home` covers `GET /acp` and its navigation. The home view has no dashboard widgets beyond the ACP layout.
- `admin-dev-redirect` covers `GET /acp/dev`, which redirects to `/acp/dev/templates`.
- `admin-trip-previews` covers `GET /acp/dev/templates` and `GET /acp/dev/templates/{template}`, including filters and multipart trip preview links.
- `admin-gig-previews` covers `GET /acp/dev/gig-templates` and `GET /acp/dev/gig-templates/{template}`.
- `admin-preview-images` covers **Запилить картинки**, a GET with `images=1` that rewrites a Blade template in either preview controller.
- `admin-svg` covers `GET /acp/dev/svg` and icons discovered from `resources/svg/*.svg`.
- `admin-thumbnails` covers `GET /acp/dev/thumbnails` and the visible Livewire image-upload workflow.
- `admin-thumbnail-post` accounts for the separately declared `POST /acp/dev/thumbnails`, which is not the visible page's Livewire upload request.
- `admin-thumbnail-clean` covers `DELETE /acp/dev/thumbnails/clean`, which clears the entire configured temp disk except `.gitignore`.
- `admin-metrics` covers `GET /acp/metrics` and `GET /acp/metrics/{event}` with weekly columns, totals, and per-day history.

## How to get to it (user POV)

- Sign in at `/auth/login` as the disposable administrator. The user menu's **Админка** opens `/acp/dev/templates` locally and `/acp/trips?user_id=1` otherwise. Bookmark `/acp` separately.
- Choose **Разработка**, whose actual href is `/acp/dev/templates`. The `/acp/dev` redirect is a separate bookmarked entry, not the menu's destination.
- Developer tabs are **Шаблоны поездок** `/acp/dev/templates`, **Шаблоны концертов** `/acp/dev/gig-templates`, **Миниатюры** `/acp/dev/thumbnails`, and **SVG** `/acp/dev/svg`.
- Click a listed template name to open its preview. Trip and gig list rows also have template icons leading to the corresponding developer preview route.
- At a preview's bottom, **Запилить картинки** adds `images=1` to that URL. Do not treat this as a read-only preview link.
- On **Миниатюры**, the visible **Фотографии** picker uploads files. **Почистить папку с загруженными файлами** submits a DELETE-method form to `/acp/dev/thumbnails/clean`.
- Under **Сайт**, choose **Метрики** `/acp/metrics`. Click an event name for `/acp/metrics/{event}`.
- All routes are also registered under `/en/acp`. `/en/acp/dev` still redirects to the literal `/acp/dev/templates`; record that locale change rather than assuming an English target.

## Driving it with Safari MCP

Preconditions:

- Follow `../SKILL.md`, require a ready isolated instance, and use its exact manifest origin in a new Safari tab. Use `root@example.com` with `top-secret` only for administrative work.
- `bootstrap/app.php` applies `auth`, `Admin`, and `AcpNavigation` to the whole ACP group. `Admin` requires `User::isAdmin()`, currently root. Metrics additionally authorize `MetricPolicy::viewAny`. Thumbnail Livewire uploads authorize `PhotoPolicy::create`.
- Check anonymous `/acp` redirects to login. Sign in as `guest@example.com` and require unauthorized access with no developer or metrics controls. Return to root for the remaining checks.
- Trip previews require an existing `Trip`; the controller uses its first row and loads its city and country. Gig previews require an existing `Gig`; the controller selects a random row. A template file alone is insufficient.
- `TripSeeder` and `GigSeeder` derive records from matching templates and known cities or artists. Select a real listed template and verify its related records, rather than guessing a filename or ID.
- Source rewriting requires a disposable verification-owned template in the copied app. Never click **Запилить картинки** on checkout files, shared copied story files, or production. Without an owned source fixture, fail that prerequisite and leave the write unexecuted.
- Thumbnail verification requires approved local JPEG or PNG files, GraphicsMagick conversion, writable run-local `uploads/temp`, and a usable Safari file picker. Missing prerequisites fail upload proof. Do not use DOM injection or direct requests to bypass the picker.
- Before cleaning, require every file on the run's temp disk to be verification-owned. The cleanup action is folder-wide, not limited to the current upload history. Never use it against shared or production storage.
- Read `.agents/guidelines/metrics.md` before interpreting metric behavior. `MetricSeeder` supplies random `IssueAdded` history. Observe actual rows, dates, and counts instead of hard-coding totals.
- Save before/action/after browser and read-only SQL or file evidence under `evidence/admin-tools/`. The helper's SQL connection must target this run, not Boost's default database.
- Discover Safari tool signatures. Extract fresh UIDs and use `page_interactions` for navigation, filters, upload selection, and confirmation. Do not call Livewire methods or submit HTTP forms behind the UI.

1. Open `/acp` as root and require the ACP menus rather than a public landing page or login form. The view `acp.index` only extends `acp.base`; do not invent widget assertions.
   Follow **Разработка** and require `/acp/dev/templates`. Independently bookmark `/acp/dev` and capture its redirect target. Repeat the English redirect entry if locale behavior is in scope.

2. On **Шаблоны поездок**, record real template links, image counts, RU and EN counts, and **Итого**. Use **Готово** choices **Нет**, **Да**, and **Неважно**, then **Переведено** choices **Да**, **Нет**, and **Неважно**.
   Require `finished=yes`, `finished=any`, and `translated=1` or `0` to match the selected filter. The default unfinished list can be empty. Use **Неважно** to establish actual templates before interpreting an empty filtered result.
   The controller accepts a plain substring `filter` query, but the template view has no text search box. Use a bookmarked `?filter=...` only as a separate entry. Do not claim a search control exists.
   Click a listed trip template name and require its rendered trip story, expected slug, and real loaded media. Dots become underscores for the Blade template name. Record the actual link rather than constructing names from titles.
   If a multipart template link contains `part={number}`, follow that link and require the intended part. Do not infer that opening the base story proves every part.

3. Open **Шаблоны концертов** through its tab and exercise the same finished and translated filter controls independently. Record its own counts and **Итого** rather than reusing the trip result.
   Click a listed concert template and require the expected concert story and media. The preview controller uses a random gig as contextual model data, so do not assert that its stored metadata belongs to that template.
   Separately follow a real concert list's template icon from `/acp/gigs`. A successful tab entry does not prove the row-icon href.

4. For source rewriting, first save the bytes of the owned template and the chosen preview URL outside the copied app. Require that this is an approved disposable source fixture with image-only lines available to convert.
   Click **Запилить картинки** on that owned preview. Capture the resulting URL with `images=1` and the rendered output. Inspect the owned file afterward and require every contiguous group of image-only lines, including a group at the end of the file and lines ending in CRLF, to become a `tpl.pic-2x` or `tpl.fotorama-2x` include.
   A `.jpeg` filename is rewritten to `.jpg`. Multiple image lines use the gallery include. With trip `part` present, inspect the `-part-{number}.blade.php` file, not the base template.
   Do not create a fixture by modifying a real story during verification. If no owned template exists, report both trip and gig rewrite journeys blocked by missing source fixtures. Ordinary previews remain independently testable.

5. Open **SVG** through its developer tab. Require visible SVG graphics and icon names in the wrapper `aria-label` values. Compare a sample with real files in `resources/svg/`.
   Capture both rendered output and extracted names. A page heading alone does not prove that SVG symbols rendered. This GET does not write source or upload files.

6. Open **Миниатюры** and choose an approved verification-owned JPEG or PNG through its visible `input[type='file'][multiple]`. Require progress to finish and **История загрузки** to show `{basename}.jpg ... ok`.
   Verify the resulting `uploads/temp/{basename}.jpg` file and inspect its dimensions and orientation. `ThumbnailMaker` applies auto-orient, resizes within 2000 by 2000, and uses quality 75. The Livewire validator allows at most 20 MB per input file.
   Reopen the page and confirm the disk file remains even though component upload history resets. The UI is an upload history, not a persistent list of every existing temp file.
   Use unique basenames. A repeated basename writes the same output path and can overwrite an earlier file. A failed or pending upload is not conversion proof.

7. Account for `POST /acp/dev/thumbnails` separately. `ThumbnailsController::store()` reads multipart `file`, converts it, renames the result under `public/uploads/temp`, and returns JSON containing `filename`.
   The current `index.blade.php` mounts `ThumbnailMaker` and contains no form or JavaScript that submits to this resource POST. Mark browser coverage of that declared POST as unavailable, not passed by the Livewire upload.
   Do not add a form, issue fetch, or post with a shell command to manufacture browser evidence. An absent or invalid file throws **Необходимо предоставить хотя бы один файл**, but that branch also lacks a current browser control.

8. After verifying the temp-disk ownership inventory, click **Почистить папку с загруженными файлами**. The real form uses POST plus `_method=DELETE` for `/acp/dev/thumbnails/clean`.
   Require return to the thumbnails page and **Папка очищена**. Inspect the temp disk and require every owned upload to be absent while `.gitignore`, when present, remains.
   Do not infer cleanup from an empty Livewire history or a success message. Save file evidence before isolated-run teardown.

9. Open **Метрики** through **Сайт**. Require event-name links and date columns from stored metrics where `date > now()->subWeek()->toDateString()`. This is a rolling date cutoff, not the calendar week. Compare visible values with `SELECT date, event, count FROM metrics WHERE event = 'IssueAdded' ORDER BY date` through the run helper.
   Click **IssueAdded** and require `/acp/metrics/IssueAdded`, the overall total, yearly totals, and daily grids. Compare sums with the same stored rows. Record blank cells for absent or zero daily values rather than treating them as failed rendering.
   Reopen the event detail as a bookmark and compare the persisted totals. The event index uses `Metric::possibleMetrics()`, so other event links can have no historical rows.
   Do not trigger unrelated user actions or run the scheduler to make this page look populated. If the seed has no usable rows after that cutoff, fail weekly-value verification and retain the independently testable historical detail result.

## Gotchas

- Source pointers are `routes/acp.php`, `app/Http/Controllers/Acp/HomeController.php`, `DevController.php`, `Dev/{Templates,GigTemplates,Thumbnails}Controller.php`, and `MetricsController.php`. Both template controllers rewrite source through `app/Domain/Life/Action/ConvertTemplateImagesAction.php`.
- Views live in `resources/views/acp/dev/` and `resources/views/acp/metrics/`. Thumbnail UI logic is `app/Livewire/ThumbnailMaker.php` with `resources/views/livewire/thumbnail-maker.blade.php`.
- Preview GETs with `images=1` write source. Browser prefetch, copied URLs, and repeat navigation must not accidentally run the rewrite on a non-owned file. Keep read-only preview URLs free of that parameter.
- Finished detection checks bare image filename lines. Translation detection compares RU and EN directive counts, not translation quality. Image counts are `.jpg` and `.jpeg` occurrences anywhere in the file, not image lines.
- `POST /acp/dev/thumbnails` and Livewire normalize filenames differently. The visible Livewire workflow always writes `.jpg`. Do not use its result to certify the resource POST's extension behavior.
- The `App\Events\Stats\*` wildcard listener writes Redis stream events, and `app:metrics:process` later aggregates the `metrics` table. Missing per-event listeners do not mean an event is unused.
- The isolated stack starts no scheduler. A click that emits a metric does not promise an immediate ACP count change. This map checks stored metrics, not end-to-end aggregation or production processing.
- Template previews can fetch real remote media. Remote publication, messaging, R2 writes, dependency installation, and shared-process changes are outside this recipe unless explicitly authorized.
