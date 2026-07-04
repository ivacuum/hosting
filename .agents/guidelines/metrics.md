# Metrics Guidelines

Site metrics flow through a wildcard event pipeline. **Never assume a `App\Events\Stats\*` event is "dead" just because `grep` finds no listener** — there is no per-event listener, by design.

## Pipeline

1. **Fired** — `event(new \App\Events\Stats\Foo)` in a controller, action, or `BeaconController` (for frontend-originated metrics).
2. **Wildcard catch** — `MetricsServiceProvider` registers `Event::listen(['App\Events\Stats\*'], WildcardMetricsListener::class)`, which pushes `{event: class_basename, data}` to a Redis Stream.
3. **Aggregation** — the scheduled `app:metrics:process` command reads the stream, aggregates counts, and writes the `metrics` table.

## Firing a metric from the frontend

Use the `Beacon` (wired on every page as `window.App.beacon`) — never one request per action:

```js
App.beacon.push({ event: 'YoutubeOpened' })        // marker
App.beacon.push({ event: 'NewsViewed', id: 123 })  // with payload
```

It batches and flushes via `navigator.sendBeacon` on `visibilitychange` / `pagehide` (or every 100 events) to `POST /js/beacon`.

## Adding a new frontend metric

1. Create the marker class in `app/Events/Stats/` (`class FooOpened {}` — no constructor, no payload).
2. Add its FQCN to `BeaconController::METRICS` (the whitelist). Marker events need no extra wiring — the generic `event(new $metrics[$event->event])` line handles them.
3. Push from JS: `App.beacon.push({ event: 'FooOpened' })`.
4. For payload events (`id`, `slug`), add a `process*` method + `match` arm in `BeaconController` (see `NewsViewed`, `TorrentViewed`).

Backend-only metrics skip steps 2–3 and just call `event(new Stats\Foo)`.

See `adr/2026-04-11-metrics-collection.md` for the full architecture.
