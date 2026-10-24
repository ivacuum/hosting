---
name: verify-website
description: Launch and drive the real ivacuum/hosting Laravel website in an isolated local stack, capture browser and database evidence, and clean up. Use for user-visible behavior, navigation, forms, localization, and regression verification.
---

# Verify Website

Hosting is the personal website branded **vacuum kaluga**. The primary surface is the Russian web UI; English lives under `/en`. The [whole-site feature map](features/README.md) covers public content, tools and trainers, accounts and travelers, administration, shared controls, machine endpoints, and supporting assets. Artisan is a verification tool, not a substitute for browser proof. This skill verifies the actual local app, not production or a PHPUnit response.

Start with the index and select the feature documents that match the change. For a whole-site run, make a per-entry checklist from every document. Keep runtime execution and externally blocked journeys separate. Never describe one representative journey as whole-site verification.

## Launch

Prerequisites: Docker running; PHP 8.5 CLI with `pcntl`, `posix`, and the project's Composer extensions, including Swoole, PDO MySQL, GD, and intl; GraphicsMagick `gm`; Node; rsync; Yarn; populated `vendor/` and `node_modules/`. The launcher checks its process-control capabilities before creating resources. The helpers do not install dependencies. If dependencies are missing, use the lockfiles (`AI_AGENT=1 composer install --no-interaction`, `yarn install --frozen-lockfile`) only with authorization. Docker may pull `mysql:8.4` and `redis:alpine`. Installed MySQL and Redis services are not required or used.

Never run `AI_AGENT=1 composer fresh` in the working checkout: its seeders prune uploads, logs, caches, and search indexes. Verification creates dedicated MySQL and Redis containers for each run. It does not read or reuse the checkout's `.env`, credentials, databases, or Redis connection. In particular, metrics use the hard-coded raw `vacuum:metrics` stream, bypassing `REDIS_PREFIX`; a prefix alone would not isolate those writes on shared Redis.

From the repository root, choose a **new, nonexistent** scratch directory outside the checkout. On this macOS harness:

```bash
export VERIFY_RUN="$(getconf DARWIN_USER_TEMP_DIR)opencode/hosting-verify-$(date +%Y%m%d-%H%M%S)-$$"
.agents/skills/verify-website/scripts/control.php launch "$VERIFY_RUN"
```

On another host, use a new directory under its harness-approved scratch root instead. Run launch through a background-capable shell tool; it waits for setup, then returns with the server running in its own process group. Preserve `VERIFY_RUN` across tool calls, or use the absolute directory printed in the manifest. Do not rerun launch on an existing run directory.

The helper copies the current working tree, including uncommitted application edits, `vendor/`, and `node_modules/`, without `.env`, Git metadata, existing uploads, cached configuration, or runtime storage. Dependencies must be real copies, not symlinks back to the checkout: Vite resolves symlinked entry points to different manifest keys. It starts uniquely labeled MySQL 8.4 and Redis containers on random loopback ports. MySQL stores its data in a disposable tmpfs mount. It builds assets only in the copied app.

It writes a fresh local `.env` with disposable credentials, migrates and runs `App\Seeder\DatabaseSeeder`, then starts Artisan `serve` with `AI_AGENT=1`, `--host=127.0.0.1`, an allocated `--port`, `--tries=1`, `--no-reload`, and `--no-interaction`. The server's process marker and PID are recorded in `instance.json`. No shared-service credential snapshot is needed.

Use the launch helper, not a guessed port. Get the exact URL from `instance.json` or doctor output. Readiness requires owned containers, a successful MySQL TCP query (not just the temporary initialization socket), responsive Redis, successful complete migrations/seeding/build, a matching served instance marker, populated feature data, and a rendered `/life` page containing `Поездки`. A green `/health-up` alone is insufficient.

Seed accounts: `guest@example.com` / `top-secret` for normal journeys; `root@example.com` / `top-secret` only for explicitly administrative work. Do not use production credentials. The helper uses file sessions/cache, a unique session cookie, `MAIL_MAILER=log`, synchronous queues, and the repository's collection search driver. It does not launch workers or the scheduler. Mail is recorded in the copied app's logs, not sent. Search-service, scheduled-job, OAuth, Telegram, R2/S3, and production FreeBSD behavior are not proved by this stack. Story, photo, and game-review images use public `https://life.ivacuum.org/` URLs; Steam artwork uses `https://shared.fastly.steamstatic.com/`. Opening these local pages can fetch real remote media automatically. Empty local uploads do not imply these images are missing. Observe each rendered image's actual URL and load state; never bulk-download or replace remote media as verification scaffolding. Inspect other outbound integrations before driving them; local mode is not a network sandbox.

Two helper-created instances can coexist: each has a different copy, HTTP port, MySQL/Redis containers and ports, uploads, cache, sessions, and cookie name. Installed MySQL and Redis must never be stopped or restarted by the helper. Never drive the shared development domain or another agent's instance. Safari tabs share a browser profile; only use a newly created tab at the run's exact origin, do not alter global browser settings or clear profile-wide storage, and coordinate if another agent controls Safari.

Teardown, including after failed drives:

```bash
.agents/skills/verify-website/scripts/control.php cleanup "$VERIFY_RUN"
```

Launch automatically invokes cleanup on setup failure; still inspect its output for cleanup errors.

## Doctor

Run this read-only check before driving and whenever the instance looks wrong:

```bash
.agents/skills/verify-website/scripts/control.php doctor "$VERIFY_RUN"
```

Require `status: ready`, the expected run ID and URL, owned server process, matching MySQL/Redis container labels, Redis PONG response, the matching served marker, seeded row counts, and usable `/life` HTML. Revision identifies the source commit; `evidence/source-status.txt` records dirty paths copied at launch. Later edits in the original checkout do **not** update this snapshot: clean up and launch a fresh run to verify them. Doctor does not certify browser authentication; for a signed-in journey also load `/my/profile` and require the expected user, not a login redirect.

## Drive

Use the existing **Safari MCP** browser harness through the tools available to the agent. Discover exact signatures before calling. In OpenCode, call via `execute` using `tools.safari`; `search({namespace: 'safari'})` lists the catalog. In Claude Code the same tools are `mcp__safari__<name>` (for example `mcp__safari__create_tab`); load them through tool search. The steps below use OpenCode names. No Playwright/Cypress harness is installed in this repo, so do not invent one or install browser dependencies.

1. `tools.safari.create_tab({url: instanceUrl + '/life'})`; record its returned handle. Do not reuse the user's active tab. Switch to that handle before subsequent actions if needed.
2. `tools.safari.get_page_content({region: 'entire_page', includeAccessibilityAttributes: true, includeURLs: true})` supplies fresh node UIDs, text, and hrefs. Prefer UIDs matched by accessible name and route. UIDs are transient; re-extract after navigation or reactive updates. Use the feature file's real `href`, input `name`, or element ID to disambiguate duplicate desktop/mobile links.
3. `tools.safari.page_interactions({interactions: [...]})` performs actual `click`, `type`, and `keyPress` actions. Use `replaceAll: true` for edits. Batch related typing and clicks; require the resulting page state before continuing. Never set Livewire properties, call component methods, or insert DOM state to simulate success.
   - Native `<select>`: `click` the select node first to open its popup, then send `selectMenuItem` with the same `node` and the option's visible `text`. `selectMenuItem` alone and arrow keys do not change the value.
   - `keyPress` accepts single named keys such as `ArrowRight` and `Return`. Modifier chords (`Alt+E`, `Ctrl+Enter`, `Ctrl+Right`) are not supported; the tool silently types their characters instead. Record shortcut-only journeys as NOT_VERIFIED with that reason rather than dispatching synthetic key events.
4. If an unlabeled field cannot be identified in text extraction, use `get_page_content({format: 'html', region: 'entire_page'})` to associate its UID with the real selector. A DOM lookup via `evaluate_javascript` can inspect/focus that input, but enter values and submit using browser interactions. Do not submit HTTP forms behind the UI for browser proof.
5. Follow the mapped entry points, including separate locale/mobile/keyboard paths when relevant. Direct navigation is a valid bookmarked entry, not evidence that a menu link works.

For administration, sign in as the disposable seeded root account and follow the admin feature files. Saves often use Livewire rather than resource POST/PUT routes. Limit deletion, batch changes, template creation, and thumbnail cleanup to verification-owned fixtures in the copied app. Missing ownership fixtures, credentials, or file-picker support must be reported. Do not bypass a missing UI control by invoking an internal component method.

Use a direct HTTP client for the machine contracts in [integrations](features/integrations.md) and status/header checks in [runtime support](features/runtime-support.md). That evidence does not certify a browser journey. MCP verification must target the disposable app, never the harness's configured production Tag Server.

For example, the account journey uses `form[action='/auth/login'] input[name='email']`, `input[name='password']`, and its `Войти` submit button, then `/my/profile` with `input[name='username']` and `Сохранить изменения`. Do not fill the hidden `mail` honeypot.

## Evidence

Keep proof in **`$VERIFY_RUN/evidence/`**, never under `$VERIFY_RUN/app/`. The helper retains setup/server/owned-container/application logs, source status, and initial doctor output. Installed-service logs are not copied. Save additional doctor output, browser actions, and read-only side effects there. Redact passwords, cookies, tokens, and personal data from shared artifacts.

For each journey, create a feature-named evidence subdirectory and an `actions.md` transcript with feature/sub-feature ID, exact origin, entry point, intended action, observed result, and pass/fail/skipped reason. Capture the before/action state **and** resulting state:

- `get_page_content({region: 'entire_page', savePath: absoluteEvidencePath})` for text/accessible structure before and after the action.
- `screenshot({savePath: absolutePngPath})` for rendered state with app identity. Scroll with browser interactions when necessary, without changing the viewport globally in a shared browser.
- Record action tool inputs/results; use `list_network_requests` and `browser_console_messages` for failing assets, navigation, or reactive requests. Save diagnostics to the evidence directory, rather than leaving them only in chat.
- For image layout, measure the displayed image, reserved frame, and controls both before and after loading using read-only browser inspection. Positive intrinsic dimensions establish that bytes loaded, not that the layout is correct. Follow the games recipe for pending and loaded layout requirements.
- Reopen saved state through another user-facing view. Verify persisted changes independently with read-only SQL:

```bash
.agents/skills/verify-website/scripts/control.php sql "$VERIFY_RUN" "SELECT id, login, email FROM users WHERE email = 'guest@example.com'"
```

This checks the MySQL container's ownership label and queries only that run's container, not Boost's default database connection. The helper accepts a single `SELECT` or `SHOW`; that prefix guard is not a SQL sandbox. Use only read-only queries, never fixture mutations. Capture stdout with redirection into `evidence/`. For file/mail effects, inspect the run's copied uploads or mail logs and preserve relevant evidence before cleanup.

Proof must exercise the real user path, record the action and result, and check side effects, not just show a final screenshot. Do not mock application internals or introduce test-only endpoints. Log mail is an existing production boundary and proves message generation only, not delivery. This is a real local run, **not a dry-run**: browser actions change its database/files and can request external media. Verify what a safe mode actually skips by inspecting files, network, or refs; never infer safety from its name.

Missing seeded prerequisites are failed journeys with a reason, not permission to weaken assertions. Missing real photos cannot be replaced with synthetic images and reported as photo proof. Images with `loading="lazy"` must be scrolled into view and given a bounded opportunity to load before assessing them: `complete: false` means pending/deferred, not a confirmed HTTP failure; `complete: true` with `naturalWidth: 0` means broken. Record pending images as unverified if they do not settle, alongside elapsed time and available network diagnostics. One passed journey does not certify other feature files or entry points.

## Cleanup

1. Finish screenshots, extracted content, transcript, SQL/file evidence, and browser diagnostics.
2. Close **only** the Safari tab handle created by this run using `close_tab({handle: recordedHandle})`. Do this even when a drive fails.
3. Run `scripts/control.php cleanup "$VERIFY_RUN"` using the full project-local path shown above. It verifies server ownership and terminates only that process group. It checks both container labels, saves their logs, and removes only those containers and their volumes. It preserves application logs and deletes only this run's copied app. It never flushes shared Redis, stops installed services, kills by process name, or resets the checkout.
4. Confirm `instance.json` has `cleaned: true`, both named containers are gone, the server port no longer answers, and proof remains in `evidence/`. Cleanup is repeatable. If Docker is unavailable or ownership mismatches, report cleanup failure and rerun after resolving it; do not broaden the kill/removal scope.

The run directory, manifest, and evidence deliberately survive teardown. Do not delete them as scratch cleanup.

## Helpers

[`scripts/control.php`](scripts/control.php) is an executable standalone PHP CLI script using native PHP functions and system tools. It does not load Composer or boot Laravel. Its detached-server handshake records ownership before allowing the server to execute. Supported invocations:

```bash
.agents/skills/verify-website/scripts/control.php --help
.agents/skills/verify-website/scripts/control.php launch "$VERIFY_RUN"
.agents/skills/verify-website/scripts/control.php doctor "$VERIFY_RUN"
.agents/skills/verify-website/scripts/control.php sql "$VERIFY_RUN" "SELECT id, login FROM users ORDER BY id"
.agents/skills/verify-website/scripts/control.php cleanup "$VERIFY_RUN"
```

After features change, use `/maintain-verification-skill` to update the map and replay affected entry points.
