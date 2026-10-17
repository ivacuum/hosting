# Developer tools

Verify the six public utilities through their real inputs, reactive results, uploads, and map editor.

## Sub-features

- `dev-base64-decode` decodes text at `/dev/base64-decoder`.
- `dev-base64-encode` encodes text at `/dev/base64-encoder`.
- `dev-hash` calculates MD5, SHA1, SHA256, SHA512, and XXH128 at `/dev/hash-generator`.
- `dev-json` formats valid JSON and reports invalid JSON at `/dev/json-formatter`.
- `dev-exif` uploads and reads JPEG metadata at `/dev/exif-reader`.
- `dev-polygon` draws and imports a WKT polygon at `/dev/map-polygon`.

## How to get to it (user POV)

- Open each `/dev/...` URL as a bookmark. There is no developer-tools index or shared navigation link in the inspected templates.
- Require the corresponding heading `Base64 Decoder`, `Base64 Encoder`, `Hash Generator`, `Json Formatter`, `EXIF Reader`, or `Полигон на карте`.
- Repeat a direct `/en/dev/...` entry and the footer language switch separately when checking localization. Utility headings remain as written above.
- Open `/dev/map-polygon?wkt=...` with a URL-encoded polygon as a separate import entry.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated instance and built assets. Start anonymous. These routes do not require authentication.
- For EXIF, provide an authorized real JPEG smaller than 20 MiB with independently known metadata, plus a JPEG without metadata and an invalid format.
- Discover Safari MCP capabilities before upload. If it cannot operate the native file chooser or attach a file to the real input, report upload verification BLOCKED. Do not assign `image`, inject a `File`, or call component methods.
- For polygon work, require Yandex map resources and a browser interaction tool that can click real map locations. Missing resources or pointer support fail that journey.

1. Open the encoder and extract HTML to identify the first textarea by `wire:model.live="input"`. The second textarea is output, not another input.
2. Replace the first textarea with `abc` using `page_interactions`. Require `YWJj` in the second after the Livewire response.
3. Open the decoder, enter `YWJj` in its first textarea, and require `abc` in the second. Also capture the default `SGVsbG8gd29ybGQh` to `Hello world!` result.
4. Open the hash generator and edit the textarea beneath `Ввод`. Require all five readonly fields to change together.
5. For `abc`, require MD5 `900150983cd24fb0d6963f7d28e17f72` and SHA1 `a9993e364706816aba3e25717850c26c9cd0d89d`. Compare SHA256, SHA512, and XXH128 with independently calculated expected values and save those values with the evidence.
6. Open the formatter and type `{"hello":"мир","n":2}` into the first textarea, identified by `wire:model.live="json"`. Require indented JSON that preserves Cyrillic and the numeric value.
7. Replace that input with `{`. Require `Specified json is invalid. Please correct it.` Then restore valid JSON and require recovery.
8. At EXIF Reader, use the real `input[type=file]` beside `Выберите JPEG-файл:`. Wait for upload completion and click `Прочитать EXIF-данные`.
9. Require the fixture's known camera/date/GPS fields where present, the actual dimensions, and the size summary. Inspect `Место снимка на карте` without following its external Google Maps href.
10. Upload the metadata-free JPEG and require `Метаданные не обнаружены` after reading. Choose a non-JPEG and require the JPEG-format validation message rather than old metadata.
11. Record temporary upload files in the copied instance. Confirm this utility does not create a gallery `images` row. The page promises deletion after five minutes, but the helper has no worker or scheduler, so verify deletion separately rather than claiming it from the text.
12. At `/dev/map-polygon`, click actual map points to draw a polygon. Require `#polygon_wkt` to update to `POLYGON(...)` with longitude before latitude and five decimal places.
13. Copy the WKT into a bookmarked query URL and reopen it. Require the same shape and fitted bounds. A malformed `wkt` must still render the empty editor without a server error.
14. Save before/action/after content, screenshots, reactive network results, and console errors for each utility. Reopening a text utility resets its default input rather than restoring saved work.

## Gotchas

- The Base64 and JSON textareas lack labels and names. Identify the first input from fresh HTML and enter text through its UID.
- Editing the result textarea proves nothing. Results are computed from the first textarea on server renders.
- Decoder input is not strict Base64 validation. Do not invent an invalid-input error contract.
- EXIF rate limits, deleted temporary files, and parser errors are distinct failures. Preserve the actual message.
- Typing into `#polygon_wkt` does not redraw the map. Import requires navigation with `wkt`; map edits update the field in the other direction.
- Source pointers are `routes/web.php`, `resources/views/dev/*`, `app/Livewire/{Base64Decoder,Base64Encoder,HashGenerator,JsonFormatter}.php`, their `resources/views/livewire/*` templates, `app/Domain/Exif/Livewire/ExifReader.php`, `resources/views/livewire/exif-reader.blade.php`, and `app/Http/{Controllers/DevMapPolygonController,Requests/DevMapPolygonForm}.php`.
