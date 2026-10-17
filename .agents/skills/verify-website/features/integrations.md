# Integration and transport endpoints

Browsers and external clients send telemetry, webhook events, image-resize requests, and MCP messages to supporting website endpoints. These are HTTP contracts, not clickable website pages.

## Sub-features

- `integration-beacon` sends browser-generated event batches.
- `integration-resize` returns an allowed resized image and rejects invalid requests.
- `integration-instagram` handles verification challenges and incoming event logging.
- `integration-telegram` accepts incoming bot updates with the configured authorization boundary.
- `integration-mcp` exposes the local Tag Server through the MCP transport.

## How to get to it (user POV)

- Normal trainer, photo, news, and video actions can cause `POST /js/beacon` when the browser leaves or hides the page.
- Image clients request `/resize/{width}x{height}/{domain}/{path}`. The allowed source domain is `life.ivacuum.org`; the path must name a real JPG or PNG.
- Instagram sends `GET` and `POST /instagram/webhook`. Telegram sends `POST /telegram/webhook`.
- An MCP client connects to `/mcp/tags`. Its registered HTTP methods are `GET`, `POST`, and `DELETE`; the installed transport accepts protocol requests through `POST`.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready. Use only the run's manifest origin. A direct HTTP client is appropriate for these machine endpoints, but not a replacement for browser feature proof.
- No production credentials or configured production MCP tools may be used. The helper does not configure Instagram, Telegram, or MCP secrets. Successful authenticated integration journeys fail their prerequisite until local-only credentials and a compatible client are supplied.
- Read `.agents/guidelines/metrics.md` before checking telemetry side effects. Event counters are aggregated from Redis by a scheduled command; the baseline stack does not run that scheduler.

- **Beacon.** Exercise a real mapped trainer or video action, then navigate away or hide the owned tab. Capture the actual `POST /js/beacon` request, its form field `events`, and the `204` response. Check the corresponding event in the run's Redis stream using the metrics documentation. An immediate SQL counter change is not required before aggregation. Do not call `App.beacon.push` to pretend the user action happened.
- **Resize success.** Use the real image path observed in a story to form a request such as `/resize/500x375/life.ivacuum.org/berlin.2017.05/IMG_0494.jpg`. Save response headers and bytes under evidence, require a valid image with the requested fit dimensions, and record the upstream request. Genuine media availability and GraphicsMagick are prerequisites. Do not substitute an unrelated placeholder if the source path fails.
- **Resize rejection.** Request an unapproved domain and require `403`. Separately use an approved domain with a size below 50 or an unsupported extension and require `422`. Confirm the rejected request does not fetch an upstream image. These rejection checks do not prove a successful resize.
- **Instagram verification.** With a local configured verification token, send `GET /instagram/webhook` with query fields `hub_mode=subscribe`, `hub_challenge=verification-challenge`, and the matching `hub_verify_token`. Require the challenge body and a local `instagram.webhook_verification_requested` log. A missing or wrong token is rejected with `403`. Never expose the token in evidence.
- **Instagram event.** Send a clearly marked synthetic incoming JSON event to the owned instance's `POST /instagram/webhook`. Require a successful empty response and matching local `instagram.webhook_received` log. This route currently logs input without a signature check; do not describe the run as a signed-webhook verification or send real account data.
- **Telegram.** For the configured-secret boundary, send the same benign update with and without `X-Telegram-Bot-Api-Secret-Token`; require only the configured matching request to pass. With no secret configured, the current app accepts requests, so the baseline cannot prove authentication. Empty `{}` input can exercise the local no-command response without contacting a chat. Real `/start`, photo commands, and callbacks can send messages or call Telegram; they need an approved test bot/chat and separate external-delivery evidence.
- **MCP transport.** Send `GET` and `DELETE /mcp/tags` and require `405` with `Allow: POST`. Use a compatible MCP client for POST initialization and tool discovery. With a blank local MCP token, require the application's `503` configuration response; with a local token configured, verify missing/wrong bearer tokens return `401` before checking authorized calls. Capture protocol errors separately from authentication failures.
- **MCP tools.** In the approved local client, discover `list-tags`, `list-untagged-photos`, `create-tag`, and `assign-tags`. Read-only calls must reflect local seeded data. Creating or assigning tags changes rows and requires verification-owned records plus read-only SQL evidence. Never use the harness's production Tag Server to verify this disposable app. A successful tools listing is not proof of mutation or idempotence.

## Gotchas

- These root endpoints do not all have `/en` aliases. The explicit route catalog is the source for registered variants.
- The MCP GET/DELETE rejection routes are not session creation/deletion. Do not expect them to manage a session.
- The resize route fetches remote bytes even on a local app. A name such as test mode does not remove that network request.
- POST webhook acceptance, logged payload, outbound bot reply, and external delivery are different observable results. Report each separately.
- Transport requests can write logs or metrics in the disposable stack. Preserve those files before cleanup and redact sensitive data.
