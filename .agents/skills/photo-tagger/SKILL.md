---
name: photo-tagger
description: "Tags published photos on vacuum.name by recognizing them with a vision-capable model and assigning tags through the production Tag Server. Activate when the user wants to tag, categorize, or label photos with the existing controlled vocabulary, or asks about the photo-tagger / Tag Server."
---

# Photo Tagger

Your goal is to walk the catalog of published-but-untagged photos on vacuum.name, recognize each one, and attach the matching tags via the production Tag Server.

## Prerequisites

The Tag Server MCP must be configured and connected in your client before running this skill. If the Tag Server tools are not available, stop and ask the user to configure it first.

## Session workflow

You keep **no state between sessions**. Do not write scripts. Do not create folders. Resume is purely in-session, tracked in your own context:

1. Start from the lowest untagged photo_id or use specific photo_id if provided by user.
2. Call `list_tags` once and hold the EN+RU label set in memory. Build the list of allowed `title_en` values and the matching `id` map.
3. Paginate `list_untagged_photos` from `<starter_id or 1>` upward until `has_more_pages` is false. Iterate the returned photos in memory.
4. Group all `curl` calls to download all photos in one go.
5. For each photo:

- Read the image at `original_url` (a public R2 URL, no auth needed) directly — you are multimodal and can see it yourself.
- Tag the photo using the system prompt:
  > You are tagging a personal photo from a trip/gig. `rel_type` is `{rel_type}` — if `Gig`, this is a concert photo; otherwise a travel photo.
  >
  > First, understand **why this photo was taken** — what is the subject, what is the photographer pointing the camera at, what is the photo "about"? Tag that, not every object visible in the frame.
  >
  > Choose zero or more tags from this list (English titles): `[sunset, railroad, ...]`. Aim for **2–3 high-quality tags** that capture the essence of the photo. Three meaningful tags beats six minor ones. A tag must describe a dominant element — the clear subject or a defining feature of the shot. Never tag minor, incidental, or background details (a tiny sign, a distant building at 10% of the frame, a passing object at the edge). When in doubt, leave it out.
  >
  > The `sky` tag is over-applied. Use it **only** when the sky is beautiful (dramatic colors, striking clouds, vivid sunset/sunrise) or absolutely dominant in the frame. A plain overcast or featureless blue sky that merely appears in the background is not `sky`.
  >
  > If a salient dominant concept is present but missing from the list, additionally propose `{new:[{ru, en}]}` entries.
  > Return strictly JSON: `{"tags": ["en-title", ...], "new": [{"ru": "...", "en": "..."}, ...]}`.
- Resolve returned EN titles to tag ids via your in-memory map.
- For each `new` entry: call `create_tag` first; append the new id to your map and the attach batch.
- If you ended up with at least one tag id: call `assign_tags` with `{photo_id, tag_ids}`.
- If vision returned no tags AND no new proposals: **do not silently skip**. Surface the photo to the user (slug + URL) and ask whether to (a) leave it untagged and move on, or (b) supply custom tags manually.
- Report progress: "photo_id=N assigned=[title_en,...]" to stderr as you go.

6. `rm` all downloaded photos in one go.
7. When the page iterator is exhausted, summarize: how many newly tagged, how many skipped, what new tags were minted.

## Idempotency & resume guarantees

- `assign_tags` uses `attach`; calling it twice with the same ids is a no-op. Re-tagging a photo from a previous session is safe.
- Re-encountering photos you processed in a *previous* session is expected; just re-tag and re-attach. If the user wants to skip already-tagged ones client-side, they can supply a starter `photo_id` that the previous session reached.
- Do not maintain any local file. The only state is what you hold in this conversation.

## Cost notes

- The corpus is ~15,000 photos and ~100 tags. Be judicious with `per_page` (50 is fine). Each photo = one model inference; warn the user before processing large batches.
- `original_url` points to the original full-resolution file (up to 2000×2000). For recognition, that's overkill — the model can read the bytes as-is, but consider that you are the one paying for the fetch.

## Error handling

- 401 from the Tag Server: the auth token is missing or wrong. Tell the user, stop.
- 429 from the `throttle:mcp` limiter (60/min per token): back off and retry with a short sleep; never hammer.
- JSON parse failure: retry once with a stricter prompt; on second failure surface the photo for manual tagging.
- Unknown tag id from `assign_tags` (you sent an id not in the DB): re-call `list_tags` to refresh your map, then retry.

## When NOT to use this skill

- Editing tag titles or deleting tags (use the ACP at `/acp/tags`).
- Ingesting brand-new photos (this skill only tags existing ones).
- Building a different MCP server for the same app.
