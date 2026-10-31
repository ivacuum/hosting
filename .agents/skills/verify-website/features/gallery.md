# Gallery

Verify personal image discovery, real image uploads, shareable thumbnails, and public full-image pages.

## Sub-features

- `gallery-own` reads authenticated `/gallery` and its pagination.
- `gallery-upload` selects real image files at authenticated `/gallery/upload` and creates stored images.
- `gallery-preview` opens public `/gallery/preview/{image}` and follows its thumbnail.
- `gallery-show` opens public `/gallery/view/{image}` and reads the original and BBCode share links.

## How to get to it (user POV)

- On the Russian desktop home page, click `Галерея` to `/gallery`. That home card is hidden on narrow screens.
- Alternatively use the `/cv` link labeled `up.ivacuum.ru`, whose actual href is `/gallery`, or bookmark `/gallery` directly.
- Signed-in gallery tabs are `Мои изображения` and `Загрузка изображений`, linking to `/gallery` and `/gallery/upload`.
- Guest's empty gallery says `Ваша галерея в данный момент пуста.` and links `Загрузите` to `/gallery/upload`.
- A personal thumbnail links to `/gallery/view/{image}`. A shared `/gallery/preview/{image}` bookmark is a separate public entry, not the personal thumbnail's href.
- On preview, click the thumbnail to reach `/gallery/view/{image}`. Open a copied full-view URL independently as a public bookmark.
- Repeat `/en/gallery`, `/en/gallery/upload`, `/en/gallery/preview/{image}`, and `/en/gallery/view/{image}`, plus the footer locale switch, as separate localized entries.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated instance, local gallery storage URLs, GraphicsMagick, and actual image files in the copied storage. Do not use production upload destinations.
- Use `guest@example.com` / `top-secret` and verify `/my/profile`. Guest initially owns no seed images.
- `ImageSeeder` creates 11 images and actual generated files for `gallery@example.com`. That account signs in with `top-secret`. Those generated pictures prove gallery storage/rendering only, not real travel-photo content.
- Discover Safari MCP upload capabilities before proceeding. The normal interaction catalog might not support native file selection or file attachment. If no supported path exists, report upload BLOCKED and do not inject files, set `files`, or call `updatedFiles()`.
- For successful upload, require authorized JPEG, PNG, and GIF files no larger than 6 MiB each. Use at least two files for combined-link behavior. A missing fixture or chooser capability fails that journey rather than allowing a simulated upload.

1. Open `/gallery` and `/gallery/upload` anonymously. Require the login gate for each. Then sign in and follow the desktop home card, tabs, and empty-state link as distinct entries.
2. Require guest's empty state before upload. Use read-only SQL to establish guest's initial `images` rows and record their IDs.
3. At upload, identify the actual `input[type=file][multiple]` with `accept="image/gif,image/jpeg,image/png"`. Choose the approved file through the native chooser or a supported real browser upload action.
4. Require `Идет загрузка...` when observable and then the resulting thumbnail and link fields. Upload starts on file selection; there is no submit button.
5. Select two approved files together. Require `Ссылки на все картинки`, a newline-separated originals textarea, a combined BBCode field, and `Индивидуальные ссылки` for both results.
6. Read the actual URLs from the rendered fields. Require loaded thumbnail dimensions greater than zero, not just nonempty `src` values.
7. Verify one new `images` row per file with guest's `user_id`, nonzero stored size, date, and slug. Independently inspect the run's gallery files for both original and `t/` thumbnail paths matching each row.
8. Reopen `Мои изображения`. Require the new thumbnails ordered newest first. Click one and require its full-view URL and successfully loaded original.
9. Verify the full view's `Ссылка:` input equals the original URL and `Полная картинка:` equals `[img]ORIGINAL_URL[/img]`. Reopen the copied share URL and require the same image identity.
10. Resolve `/gallery/preview/{image}` from the actual created row ID as a bookmarked share entry. Require its thumbnail and original share fields. Click its thumbnail and require the same full view.
11. Sign out and reopen both copied preview and view URLs. Require their images and share links to remain readable, without private gallery tabs. Neither route has an auth middleware gate.
12. Sign back in and require only guest-owned images in `Мои изображения`, not the separate gallery seeder account's rows. Cross-check ownership through read-only SQL.
13. Choose an unsupported file and require the real validation error with no corresponding row or stored gallery image. Separately choose a file above 6 MiB and require size validation.
14. If the owned list has more than 25 images, follow real paginator links and require correct ownership/order on both pages. Standard guest seed data cannot prove pagination; missing authorized uploads are a failed prerequisite for that sub-feature.
15. Open the public URLs through the footer locale switch and direct English bookmarks. Require the same row/image and localized navigation where rendered. The share-field labels in preview/view remain Russian in these templates.
16. Save before/action/after content, loaded image URLs/dimensions, upload network responses, ownership SQL, and original/thumbnail file evidence. Reload the personal list to prove persistence independently of upload results.

## Gotchas

- Browsers ignore the upload input's `max="10"`, so choosing more files is possible. The component rejects a selection of more than ten files with `За один раз можно загрузить не более 10 файлов` and saves none of them.
- Originals are processed images, not byte-identical originals. `Image::upload()` auto-orients and fits within 2000 by 2000; thumbnails fit within 150 by 150. EXIF/profile preservation is not the gallery contract.
- PNG output keeps PNG. Other accepted formats use a `.jpg` slug. Large GIF resizing selects the first frame; do not require animated previews.
- Every BBCode field, including each individual upload result's `Полная картинка`, uses the original URL: `[img]` + that entry's `Ссылка` + `[/img]`.
- The index displays `views`, but `GalleryController::show()` does not increment that field. Views come from the separate `ImageViewerServer` process, which this stack does not run. Do not demand a count increment merely because the full image was opened.
- Seeded gallery fixtures are available for public preview/show checks even when browser upload is blocked. Their success does not prove upload or guest ownership.
- Source pointers are `routes/web.php`, `resources/views/gallery/*`, `resources/views/{index,cv}.blade.php`, `resources/views/livewire/gallery-uploader.blade.php`, `app/Http/Controllers/GalleryController.php`, `app/Livewire/GalleryUploader.php`, `app/Models/Image.php`, and `app/Seeder/ImageSeeder.php`.
