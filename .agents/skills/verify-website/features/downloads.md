# Downloads

Verify the public file catalog and the counted redirect that starts a file download, without treating a redirect as proof of received bytes.

## Sub-features

- `downloads-index` covers `GET /files`, published rows, ordering, and pagination when more than forty rows exist.
- `downloads-file` covers `GET /files/{file}/dl`, its publication guard, download counter, and storage redirect.
- `downloads-language` covers `/en/files` and `/en/files/{file}/dl` without changing file identity.
- `downloads-context` covers downloads linked from DC guides, retracker instructions, and magnet help.

## How to get to it (user POV)

- Bookmark `/files`, or click CV portfolio link `dl.ivacuum.ru` with href `/files`.
- Click a file title in the catalog. Its href is `/files/{id}/dl`, not a file-detail page.
- Click a DC client's `Скачать` button or an earlier-version link. Both use the same counted route.
- Retracker links use `/files/122/dl`, `/files/123/dl`, and `/files/124/dl` for source, Windows settings, and Linux settings.
- `/magnets/faq` links `qBittorrent` to `/files/158/dl` and `Transmission` to `/files/151/dl`.
- Use the catalog footer's locale switch, or open a copied English download URL directly.

## Driving it with Safari MCP

Preconditions:

- Require the ready isolated instance. No account is needed. `FileSeeder` supplies five published rows and one hidden row.
- Seeded titles, extensions, folders, and initial download counts are random. Record actual values with the run's read-only SQL helper before clicking.
- `FileSeeder` writes an empty placeholder at each seeded row's `folder/slug.extension` on the isolated `files` disk. Standard seeding supplies no real payloads and no historical file IDs used by DC or retracker pages.
- A complete byte-download journey requires the real intended file. A zero-byte placeholder proves the redirect target resolves, not the payload. Missing historical records are failed prerequisites, not permission to invent replacement files.

1. Open `/cv`, click `dl.ivacuum.ru`, and require `/files`. Independently bookmark `/files` to cover direct entry.
2. Require the five published title links and columns for ID, title, size, download count, and creation date. Confirm descending IDs and exclusion of the hidden row against read-only SQL.
3. Record one visible row's `id`, `folder`, `slug`, `extension`, and `downloads`. Inspect its href and require `/files/{id}/dl`.
4. Click that title through Safari interactions. Capture the local request, redirect status, and `Location` destination. Require the destination to match the `files` disk URL plus `folder/slug.extension`.
5. Read that row again and require `downloads` to increase by one. Reopen `/files` and require its updated count. A broken destination still counts the redirect click.
6. If the real payload exists, inspect the resulting download or rendered file and require the intended filename and bytes. Record Safari's actual outcome. A screenshot of the original catalog does not prove a completed download.
7. With the default seeds, require the destination to return the zero-byte placeholder. Record the byte-content journey as NOT_VERIFIED even when the counter and redirect pass. Save the destination response and do not replace the placeholder with a synthetic payload.
8. Open the hidden row's `/files/{id}/dl`. Require 404 and no counter change. Repeat for a confirmed nonexistent ID and require 404 rather than a redirect.
9. Return to `/files` and click `In English`. Require `/en/files` with the same published IDs and titles. Click the same file and require the same storage target and one more counted click.
10. If more than forty published files exist, click the visible `a#next_page[rel='next']` with href `/files?page=2` and require the next page's rows. Return through `a#prev_page[rel='prev']`. Standard seeds cannot prove second-page navigation. Report that missing prerequisite for the pagination journey.
11. Visit one DC client page, `/retracker`, and `/magnets/faq`. Record each source label and intended file ID before clicking its download link. Check the intended record first, then record missing-record failures without relabeling the random catalog files as those downloads.
12. Save before/action/after browser content, redirect diagnostics, and read-only counter evidence under the run's downloads evidence directory.

## Gotchas

- The controller increments before redirecting and does not read or verify the payload. A counter increase proves a click, not a successful transfer.
- Directly opening the storage URL bypasses the counted download route and cannot prove catalog navigation.
- Inspect the run's disk configuration before following a redirect. A configured remote file host is an external network boundary.
- No public upload, edit, or delete operation exists here. File administration belongs to separate administrative verification.
- Sources are `routes/web.php`, `FileController`, `File`, `FileSeeder`, `FileFactory`, `config/filesystems.php`, `files/index.blade.php`, CV, DC/retracker templates, and `magnets/faq.blade.php`.
