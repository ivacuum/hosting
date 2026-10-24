# Admin content

Verify that an administrator can find and maintain the site's content records, photo tags, and trip covers without touching shared content or external publishing accounts.

## Sub-features

- `admin-artists` covers the artist list, detail, create form, edit form, and deletion.
- `admin-cities` covers city search, country filtering, coordinates, detail, creation, editing, and deletion.
- `admin-countries` covers country totals, related cities and trips, detail, creation, editing, and deletion.
- `admin-dcpp-hubs` covers hub addresses, statuses, detail, creation, editing, and deletion.
- `admin-files` covers file metadata, local upload, download, detail, creation, editing, and record deletion.
- `admin-gigs` covers artist filtering, detail, creation, copy-from-existing, editing, and deletion.
- `admin-news` covers locale-scoped lists, Markdown detail, creation, editing, comments, and deletion.
- `admin-photos` covers filtered lists, detail, upload, tag editing, individual tag removal, all-tag removal, and deletion.
- `admin-social-media-posts` covers status lists, detail, random-photo selection, creation, editing, and deletion. External publication is separate.
- `admin-tags` covers bilingual tags, photo counts, detail, creation, editing, and deletion.
- `admin-trips` covers search and status filters, detail, creation, editing, deletion, and the Instagram cover page.
- Each resource above declares `GET /acp/{resource}`, `GET /acp/{resource}/create`, `GET /acp/{resource}/{id}`, `GET /acp/{resource}/{id}/edit`, and `DELETE /acp/{resource}/{id}` in `routes/acp.php`.
- Resource `POST` and `PUT` saves are deliberately absent. `ResponseToCreateAction` and `ResponseToEditAction` render Livewire forms whose visible submit buttons save the records.

## How to get to it (user POV)

- Sign in through `/auth/login` as the disposable instance's administrator. The user menu's **Админка** links to `/acp/dev/templates` locally and `/acp/trips?user_id=1` otherwise. Bookmark `/acp` separately for the home page.
- Open **Заметки** for **Города** `/acp/cities`, **Страны** `/acp/countries`, **Поездки** `/acp/trips?user_id=1`, **Концерты** `/acp/gigs`, and **Артисты** `/acp/artists`.
- The same menu has **Тэги** `/acp/tags`, **Фотки** `/acp/photos`, and **Посты** `/acp/social-media-posts`.
- Open **Ресурсы** for **DC++ хабы** `/acp/dcpp-hubs`, **Файлы** `/acp/files`, and **Новости** `/acp/news`.
- Click a row's linked title, ID, or photo to open its detail. The detail sidebar has **Редактирование**, **Удалить**, and **Смотреть на сайте** where supported.
- Create links read **Новый артист**, **Новый город**, **Новая страна**, **Новый хаб**, **Новый файл**, **Новый концерт**, **Написать новость**, **Новая фотка**, **Новый пост**, **Новый тэг**, and **Новая поездка**.
- Country counts open `/acp/cities?country_id={id}` and `/acp/trips?country_id={id}`. City counts open `/acp/trips?city_id={id}`. Artist counts open `/acp/gigs?artist_id={id}`.
- Tag photo counts open `/acp/photos?tag_id={id}`. Trip photo and comment counts open `/acp/photos?trip_id={id}` and `/acp/comments?trip_id={id}`.
- The concert copy icon links to `/acp/gigs/create?source_id={id}`. A trip's Instagram icon links to `/acp/trips/{id}/instagram-cover` only when `meta_image` exists.
- `/en/acp/...` is also registered. Test locale entry independently. ACP menu links contain literal `/acp/...` hrefs, so do not assume they preserve English.

## Driving it with Safari MCP

Preconditions:

- Follow `../SKILL.md` and require a ready isolated run. Use its exact origin and a new Safari tab. Sign in as `root@example.com` with `top-secret` only to administer this instance.
- `bootstrap/app.php` applies `auth`, `Admin`, and `AcpNavigation` to both ACP prefixes. `User::isAdmin()` currently requires `isRoot()`. Resource policies require root, including create authorization on most Livewire saves.
- First check anonymous `/acp/cities` redirects to login. With `guest@example.com`, require an unauthorized response and no content controls. Return to root for the remaining journeys.
- Read seeded content without changing it. Mutations and deletions require separately identified, verification-owned disposable records and files in this run. Never delete or repurpose root, shared seed records, or production objects.
- Reserve a run-specific slug and bilingual titles. `LifeSlug` checks artists, cities, gigs, and root-owned trips together. Use a disposable country, city, artist, trip, and gig dependency chain where needed.
- Confirm `photos`, `files`, and upload temporary storage resolve inside the copied app. Keep the scheduler stopped. External publishing, real messaging, or remote storage writes require explicit approval before the action.
- Missing related objects, eligible social photos, a real upload file, a usable Safari file picker, or image-conversion support fail the corresponding journey. Do not substitute a synthetic image and report real-photo proof.
- Save before/action/after text, screenshots, action inputs, reactive failures, and run-scoped read-only SQL under `evidence/admin-content/`. Use `control.php sql` from the skill, never Boost's default connection.
- Discover Safari tool signatures. Extract fresh `get_page_content` UIDs before `page_interactions`. Fields below name actual `wire:model` properties, not HTML `name` attributes. Inspect HTML to find the matching input and operate it through the UI.

1. Open every named menu entry and record its resulting href, heading, rows, total, and pagination where present. Exercise a sortable header and reset filters through **Сбросить все фильтры** where shown. A bookmarked detail does not prove a menu link.

2. For artists, click **Новый артист**. Fill `title` and a unique `slug`, then click **Добавить артиста**. Require the new linked title in `/acp/artists` and matching `artists.title` and `artists.slug`.
   Open `/acp/artists/{id}`, expand **JSON**, and follow **Редактирование**. Change `title`, click **Сохранить**, and reopen the edit form to prove persistence. Check the concert-count href on a seeded artist separately.
   Delete only the owned artist after removing its owned gigs. Accept **Запись будет удалена. Продолжить?** and require the list redirect and absent artist row. The observer invalidates concert caches, not a documented cascade of gigs.

3. For countries, click **Новая страна**. Fill `titleRu`, `titleEn`, unique `slug`, `emoji`, and `hashtags`, then **Добавить страну**. Check `countries.title_ru`, `title_en`, `slug`, `emoji`, and `hashtags`.
   Open the country detail and its nonzero city and trip relation links. Edit `hashtags` through **Редактирование** and **Сохранить**, then reopen. Keep empty relation links distinct from missing controls.
   Delete the owned country only after removing its owned dependent cities and trips. Require its database row to disappear. The country observer clears geographic caches and does not delete those dependencies for you.

4. For cities, search with `input[name='q']` using a real Russian or English title. Follow a country's city-count link and require `country_id` to constrain the list.
   Click **Новый город**. Select `countryId`, fill `titleRu`, `titleEn`, unique `slug`, `hashtags`, optional three-character `iata`, `lat`, and `lon`, then **Добавить город**. A live `lat` value containing `, ` splits into both coordinate fields.
   Open the city's detail and country sidebar link. Edit the owned city's hashtags and coordinates, click **Сохранить**, and reopen. Verify the saved `cities.country_id`, bilingual titles, and point coordinates with read-only SQL.
   Delete only the owned city after its owned trips and gigs are removed. Require the row to disappear. An IATA value of another length raises a domain error, not a successful save.

5. For DC++ hubs, click **Новый хаб**. Fill `title`, `address`, `port`, and `status`, then **Добавить хаб**. Use a non-routable verification address. A valid port is between 1 and 65535.
   Open the detail's **JSON**, edit the owned hub's title and hidden status, and click **Сохранить**. Reopen and compare `dcpp_hubs.title`, `address`, `port`, and `status`. The list displays online state but this form does not probe a hub.
   Click **Удалить** on the owned hub and confirm. Require its database row to disappear. Do not launch a DC++ client or claim an outbound connection was checked.

6. For files, click **Новый файл**. Fill `title`, unique `slug`, and a run-specific `folder`. Select `status`, choose an approved local file through the visible file picker bound to `upload`, and click **Добавить файл** after upload completion.
   Require a `files` row with the real byte size and extension, plus the matching file at `uploads/files/{folder}/{slug}.{extension}`. Open the detail's **Скачать** link and check the returned local file, not merely the metadata.
   Edit the owned file's `title` and `status` through **Сохранить**. Reopen and verify persistence. The edit UI does not expose `slug`, `folder`, or another file upload.
   Delete the owned file record and require its row to disappear. `FileObserver` has no file-deletion hook, so record the remaining uploaded file separately rather than claiming disk cleanup.

7. For gigs, follow an artist's concert count and require the `artist_id` filter. Click **Новый концерт** and select `artistId` before finalizing the slug and titles, because the live artist selection overwrites them.
   Select `cityId`, fill `titleRu`, `titleEn`, unique `slug`, and `date`. Select a hidden `status`, fill `metaDescriptionRu`, `metaDescriptionEn`, and optional `metaImage`, then **Добавить концерт**. Check the corresponding `gigs` columns.
   Open the owned gig detail and edit its date and description through **Сохранить**. Reopen. Separately click **Создать похожий концерт** on its list row and require copied fields with hidden status. Change the duplicated slug before saving another owned gig.
   Check the row's `/acp/dev/gig-templates/{template}` link against [admin tools](admin-tools.md). A newly created slug has no automatic Blade story template. Delete only owned gigs and verify row absence, not photo cleanup.

8. For news, click **Написать новость**. Fill `title`, `markdown`, and hidden `status`, then **Добавить новость**. Check `news.locale` equals the active locale and `news.user_id` equals the administrator.
   Open the detail and inspect rendered Markdown. Edit `markdown` through **Сохранить**, reopen, and compare both saved Markdown and rendered content. Follow a real comment-count link to `/acp/comments?news_id={id}`.
   Repeat the list entry under `/en/acp/news` to check locale scoping. Delete only owned news and owned comments. `NewsObserver` deletes related comments before removing the news record.

9. For photos, use **Без тэгов** and **Без гео**, which set `filter=no-tags` and `filter=no-geo`. Check `trip_id` and `tag_id` relation entries separately. Open a seeded thumbnail and inspect the actual original's URL and loaded dimensions.
   For upload proof, click **Новая фотка**, or **Добавить фотографии** on an owned trip. Select either `tripId` or `gigId`, keep **Перезаписать изображение, если такое уже есть на сервере** at **Нет**, and choose approved JPEG or PNG files of at most 20 MB each.
   Require **История загрузки** to finish each file with `ok`, not **Ожидает загрузки** or an error. Check `photos.rel_type`, `rel_id`, `slug`, `user_id`, hidden status for new rows, available EXIF fields, and the local `photos` disk file. A gig upload uses the `gigs/` directory prefix.
   Open `/acp/photos/{owned-id}/edit`. Select two owned tags using the `tags` checkboxes and click **Сохранить**. Reopen and verify `taggable` rows with this photo's morph type and ID. This form changes tags, not photo title, status, or bytes.
   On its detail, click **Удалить тэг {title}** for one owned tag. Require only that pivot row to disappear through `DELETE /acp/photos/{id}/tags/{tag-id}`. The tag and photo records must remain.
   Reattach the owned tags through the edit UI. Click **Удалить все тэги**, accept **Удалить все тэги?**, and require all this photo's pivots to disappear through `DELETE /acp/photos/{id}/tags`. Reopen to prove persistence.
   Before deleting the owned photo, remove any owned social post that references it. Click **Удалить** and require the photo row and its local original to disappear. `PhotoObserver::deleted()` detaches its tags and deletes its configured disk file. Require zero remaining `taggable` rows for the photo; any remaining row is a failure.

10. For social posts, require at least three unassigned, verification-owned trip photos owned by root, with valid trip, city, and country relations. Selection has no fixture filter, so do not save if the form randomly chooses a shared seed photo. Click the displayed photo to choose another eligible owned photo before saving. Verify the caption initially combines city and country hashtags.
    Fill `caption` and a unique future `publishedAt`, leave **В очереди**, then **Добавить пост**. The successful create redirects back to `/acp/social-media-posts/create`, not the list. Find the saved post in the queued list and verify `social_media_posts.photo_id`, `user_id`, `caption`, `status`, and `published_at`.
    Open its detail, follow the author and photo sidebar links, then edit the caption through **Сохранить**. Reopen and check that the existing post's photo cannot be changed by clicking it.
    On a separate owned queued post, choose **Исключен** and save. Require an empty caption, null `published_at`, and set `excluded_at`. Published and excluded states are final. Do not attempt to restore them to queued.
    Exercise **В очереди**, **Опубликован**, and **Исключен** list filters separately. Selecting **Опубликован** in this form records a state, not proof of delivery to Instagram or Telegram. Actual external publication requires explicit approval and credentials.
    Delete only the owned post and require its row to disappear while its photo remains. No social-post seeder is called by `DatabaseSeeder`, so absent rows are not proof of list or detail behavior.

11. For tags, click **Новый тэг**. Fill unique `titleRu` and `titleEn`, then **Добавить тэг**. Open its detail, inspect **JSON**, edit a title through **Сохранить**, and reopen to verify both saved names.
    Attach this owned tag to an owned photo through the photo edit UI. Follow the tag's photo-count link and require `/acp/photos?tag_id={id}` to contain that photo.
    Delete the owned tag and require its row and related `taggable` links to disappear. `TagObserver` detaches the tag from photos. The photo row and bytes must remain.

12. For trips, exercise `q`, **Другие**, and each status filter separately. Check city and country relation entries independently. Root's menu starts with `user_id=1`, not all travelers.
    Click **Новая поездка**, select `cityId`, then finalize a unique `slug`, `dateStart`, `dateEnd`, `status`, `metaDescriptionRu`, `metaDescriptionEn`, and optional `metaImage`. Click **Добавить поездку**. The live city choice supplies titles, which are not editable on the create form.
    Open the owned trip and **Редактирование**. Edit `titleRu`, `titleEn`, and descriptions, then **Сохранить**. Reopen and compare `trips` fields. Reject an end date before the start date without saving.
    If testing status or slug changes, use only owned related photos. Require `TripObserver` to update photo visibility and slug prefixes. The observer changes photo metadata, not a demonstrated move of image files.
    With a real seeded trip cover, click its Instagram icon. Require `/acp/trips/{id}/instagram-cover`, the trip title, country flag, period, and loaded cover image. This GET renders artwork without publishing it. An existing trip without `meta_image` must return 404 on that route.
    Delete only an owned trip after removing its owned photos. Require the trip and its owned comments to disappear. `TripObserver` deletes comments but does not delete the trip's photos or their files.

## Gotchas

- Source pointers are `routes/acp.php`, `app/Http/Controllers/Acp/*Controller.php`, `app/Livewire/Acp/*Form.php`, and their `resources/views/acp/` and `resources/views/livewire/acp/` templates. Social-post saves live in `app/Domain/SocialMedia/Livewire/SocialMediaPostForm.php`.
- Destruction uses `ResponseToDestroyAction::execute()` and model observers under `app/Observers/` and `app/Domain/Life/Observer/`. A JSON `OK`, a disappearing row, or a flash alone does not prove database or disk effects.
- `app/Seeder/DatabaseSeeder.php` calls the life, file, hub, and news seeders. `FileSeeder` creates metadata without bytes. `PhotoSeeder` creates Moscow, Osaka, and Suwon metadata with existing tags, not local originals. Treat missing download or upload prerequisites as failed journeys.
- `Photo::originalUrl()` always targets public `life.ivacuum.org`, even after a local upload. Local disk upload proof does not prove that remote image exists. Never upload to production to repair that difference.
- `PhotoUploadForm` updates matching upload metadata even with overwrite disabled. `gigId` wins if both relation selectors are filled. Use one owned relation and a unique filename to avoid touching another image.
- Social-post creation redirects to another create form that immediately picks an unassigned photo. Exhausting eligible photos can fail that destination even after a row was saved. `PickRandomPhotoAction` also needs a second eligible photo for reselection.
- Publishing pending comments can notify subscribers. Use the isolated log mailer and the messaging safeguards in [admin moderation](admin-moderation.md). The stopped scheduler is not an external-network sandbox.
- No story Blade file is created by a gig or trip metadata save. Broken public-story links on new slugs are failures to record, not permission to edit application templates during verification.
- Empty relation counts suppress detail-sidebar links through `GetModelAccessibleRelationsAction`. Require a real related fixture before claiming those paths passed.
