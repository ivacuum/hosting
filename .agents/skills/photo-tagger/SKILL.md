---
name: photo-tagger
description: "Tags published photos on vacuum.name by recognizing them with a vision-capable model and assigning tags through the production Tag Server. Activate when the user wants to tag, categorize, or label photos with the existing controlled vocabulary, or asks about the photo-tagger / Tag Server."
---

# Photo Tagger

Your goal is to walk the catalog of published-but-untagged photos on vacuum.name, recognize each one, and attach the matching tags via the production Tag Server.

## Prerequisites

The Tag Server MCP must be configured and connected in your client before running this skill. If the Tag Server tools are not available, stop and ask the user to configure it first.

## Session workflow

You keep **no state between sessions**. Do not write scripts. Do not create folders or subdirectories (never run `mkdir`). Resume is purely in-session, tracked in your own context:

- **Local Application Isolation**: Do not query the local Laravel application database or run SQL queries. Rely solely on the Tag Server MCP.
- **No Artifacts**: Do not generate markdown files or artifacts for tagging summaries. Always print the tagging summary and detail tables directly to the user in the final text response.
- **Direct Downloads**: Always download photos directly into the root of the existing session scratch directory as `<photo_id>.jpg` without creating any subdirectory.

### Concurrency safety invariant

Parallelism is allowed **only for downloading photo bytes**. After the download command completes, process photos strictly one at a time.

- Never issue parallel image `read` calls, include multiple images in one vision request, or delegate recognition to parallel subagents.
- Never recognize several photos first and assign their tags later. Recognition and assignment form one indivisible per-photo transaction.
- Keep exactly one active work item: `{photo_id, local_path, rel_type, slug, original_url}`. The `photo_id` must come from that work item, never from response order or memory of the previous photo.
- Do not open the next image until the active photo has been assigned, explicitly skipped, or surfaced to the user for a decision.
- Before calling `assign_tags`, verify that its `photo_id` equals the numeric basename of `local_path`. If they differ, stop without assigning and reconstruct the active work item from the untagged-photo record.

This serialization is intentional. Do not optimize it away with parallel tool calls; correctness of the photo/tag relationship is more important than recognition throughput.

1. Start from the lowest untagged photo_id or use specific photo_id if provided by user.
2. Call `list_tags` once and hold the EN+RU label set in memory. Build the list of allowed `title_en` values and the matching `id` map.
3. Paginate `list_untagged_photos` from `<starter_id or 1>` upward until `has_more_pages` is false. Iterate the returned photos in memory.
4. Download all photos directly into the scratch folder in a single parallel `curl` invocation. 
   
   **Exact `curl` command structure:**
   ```bash
   curl -s -Z --output-dir <scratch_dir> -o <photo_id_1>.jpg <url_1> -o <photo_id_2>.jpg <url_2> ...
   ```
   * **`-s`**: Silent mode.
   * **`-Z` / `--parallel`**: Downloads all files concurrently over HTTP/2 multiplexing.
   * **`--output-dir <scratch_dir>`**: Saves files directly into the session's scratch folder.
   * **`-o <photo_id>.jpg <url>`**: Chains 1-to-1 explicit output filenames with matching URLs.
   * **CRITICAL RULE**: **NEVER use the `-O` (uppercase O) flag anywhere in the `curl` command.** `-O` consumes an unmapped URL argument, which causes a fatal off-by-one misalignment across all downloaded filenames.
5. For each photo, complete this entire transaction before proceeding to the next photo:

- Set the active work item from one `list_untagged_photos` record.
- Read exactly one local image at `<scratch_dir>/<photo_id>.jpg`. Do not read `original_url` after downloading the batch, and do not read any other image in the same tool call.
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
- If you ended up with at least one tag id: verify the active `photo_id` against the local filename, then immediately call `assign_tags` with `{photo_id, tag_ids}`. Do not defer or batch assignments.
- If vision returned no tags AND no new proposals: **do not silently skip**. Surface the photo to the user (slug + URL) and ask whether to (a) leave it untagged and move on, or (b) supply custom tags manually.
- Report progress: "photo_id=N assigned=[title_en,...]" to stderr as you go.
- Clear the active work item only after assignment or an explicit skip, then begin the next photo.

6. `rm` all downloaded photos in one go.
7. When the page iterator is exhausted, summarize directly in the chat response (do not create files or artifacts): how many newly tagged, how many skipped, what new tags were minted, and a table of the tags assigned to each photo.

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
