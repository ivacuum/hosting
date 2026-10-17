# Admin moderation

Verify chat, comment, image, issue, and magnet moderation through the administrator's real controls and check each record's resulting state.

## Sub-features

- `admin-chat` covers `GET /acp/chat-messages`, detail, edit, and `DELETE /acp/chat-messages/{id}`. `POST /acp/chat-messages/batch` supports `hide`, `publish`, and `delete`.
- `admin-comments` covers `GET /acp/comments`, detail, edit, and `DELETE /acp/comments/{id}`. There is no comment create page or batch route.
- `admin-images` covers `GET /acp/images`, detail, `DELETE /acp/images/{id}`, and `POST /acp/images/batch` with `delete`.
- `admin-image-view` covers `GET /acp/images/{id}/view`, which increments the image's view counter and returns to the referring page.
- `admin-issues` covers `GET /acp/issues`, detail, and `DELETE /acp/issues/{id}`. Issues have no ACP create or edit page.
- `admin-issue-state` covers `POST /acp/issues/{id}/close` and `POST /acp/issues/{id}/open` with their state preconditions.
- `admin-issue-batch` covers the declared `POST /acp/issues/batch` actions `close`, `open`, and `delete`, including the current UI request mismatch.
- `admin-magnets` covers `GET /acp/magnets`, detail, edit, and `DELETE /acp/magnets/{id}`. The detail also has an externally backed replacement form.
- Chat, comment, and magnet edits use `GET /acp/{resource}/{id}/edit` and Livewire submits. Missing resource `POST` and `PUT` save routes are intentional in `routes/acp.php`.

## How to get to it (user POV)

- Sign in at `/auth/login` with the isolated administrator. The user menu's **Админка** opens `/acp/dev/templates` locally. Bookmark `/acp` separately.
- Under **Ресурсы**, choose **Чат** `/acp/chat-messages`, **Комментарии** `/acp/comments`, **Изображения** `/acp/images`, or **Магнеты** `/acp/magnets`.
- Under **Сайт**, choose **Обращения** `/acp/issues`.
- Chat and comment IDs open details. Magnet titles and image thumbnails open details. An issue's title opens its detail.
- Detail sidebars expose **Редактирование** only for chat, comments, and magnets. **Удалить** uses the current model's DELETE URL.
- User relation links lead to `?user_id={id}` lists. Comment-count links on trips, news, magnets, and issues lead to `?trip_id=`, `?news_id=`, `?magnet_id=`, or `?issue_id=` lists.
- Image details have **Засчитать просмотр** `/acp/images/{id}/view` and **Картинки автора** `/acp/images?user_id={id}`.
- Chat, image, and issue lists have row checkboxes, an action selector, and **Выполнить**. The header checkbox selects every visible row, not just verification-owned rows.
- English route equivalents are under `/en/acp`. ACP menu links often lead back to Russian `/acp` URLs. Record the actual href and locale.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated run from `../SKILL.md`. Use the manifest origin, a new Safari tab, and `root@example.com` with `top-secret` for ACP work only.
- `bootstrap/app.php` wraps all these routes in `auth` and `Admin`. `Admin` requires `User::isAdmin()`, currently `isRoot()`. Resource policies separately require root for viewing, updating, and deleting.
- Check an anonymous bookmark redirects to login. Sign in as `guest@example.com` and require unauthorized access without moderation controls. Return to root before editing anything.
- Use seeded rows only for read-only discovery. Changes, view increments, replies, batches, and deletion require disposable verification-owned rows in this run. Never mutate root, shared seed records, or production records.
- Prepare owned chat messages, comments with valid parents, gallery images with local bytes, open and closed issues, and magnets with valid authors. Do not create fixtures through synthetic HTTP or hidden Livewire calls.
- If the existing UI cannot provide a required fixture, report the journey failed for that missing prerequisite. Fixture creation through another approved workflow does not count as ACP create coverage.
- Confirm gallery storage is run-local and the mailer is `log`. Comment publication and replies can generate notifications. External messaging requires explicit approval before sending and must not use a shared recipient.
- `ImageSeeder` generates gallery fixtures, but they are not automatically verification-owned destructive targets. `IssueSeeder` supplies open and closed issues, and its closed **Поездки на главной** issue has a comment. Other seed IDs and counts must be observed.
- Save browser before/action/after evidence and run-scoped SQL under `evidence/admin-moderation/`. Use `control.php sql` from the skill for read-only checks, never the default application connection.
- Discover Safari signatures, extract fresh UIDs, and use `page_interactions`. Match edit fields by their actual `wire:model` properties in HTML. Do not call component methods, forge batch payloads, or inject missing options.

1. Open each menu entry and require its real rows, total, and pagination. Follow a user relation filter, use a sortable header, and check the resulting query and order before resetting filters.

2. On **Чат**, use **Скрытые** and **Все**. The controller supports `status` and `user_id`, with ID sorting and 40 rows per page.
   Open an owned chat ID, inspect its rendered text, then click **Редактирование**. Change `text`, select `status`, and click **Сохранить**. Reopen and compare `chat_messages.text` and `status`.
   On the list, select only owned message checkboxes `input[name='ids[]']`. Choose **Скрыть**, click **Выполнить**, and require each selected row to become hidden while an unselected owned control row remains unchanged.
   Repeat with **Опубликовать** and require published status. `batch-form.js` sends `ids[]` and `action` to `/acp/chat-messages/batch`, then reloads regardless of the returned result. Verify persistence rather than trusting the reload.
   Use **Удалить** and **Выполнить** only on owned messages reserved for batch deletion. Verify their rows disappear. Separately delete another owned message from its detail and confirm the DELETE path and list redirect.

3. On **Комментарии**, exercise **Скрытые**, **Ожидает активации**, **Опубликованные**, and **Все**. Follow one real parent relation and one author relation. Require the `rel_type`, `rel_id`, and author to match the filter.
   Open an owned comment and **Редактирование**. Change `html`, select `status`, and click **Сохранить**. Reopen to prove the `comments.html` and `status` changes. This edits HTML, not the public plain-text comment input.
   For an owned pending comment, publication resets `created_at` and emits `CommentPublished`. Verify only local generated mail and relevant persisted notification records when present. A successful edit does not certify external delivery.
   Delete a separate owned comment through its detail's **Удалить** and confirmation. Require its row to disappear without deleting the parent record. There is no ACP batch delete for comments.

4. On **Изображения**, switch **Миниатюра** to **Оригинал** with `image_size=original`. Exercise the year links, inactivity links `touch={years}`, and author filter separately. The controller also accepts `user_id`, and sorts ID, size, views, or updated time.
   Scroll a selected image into view and require loaded dimensions. Open its detail through the thumbnail or eye icon. Inspect the original secret URL and **JSON**. Missing or pending media is not a successful visual check.
   Record an owned image's `views`, then click **Засчитать просмотр**. Require return to the referring page and exactly one additional view in `images.views`. This GET is a write, so do not test it on a shared row.
   Follow **Картинки автора** and require `/acp/images?user_id={author-id}`. There is no image metadata edit form.
   On an owned image's list row, click the trash icon `.js-image-delete`. It hides `#image_{id}` after a successful JSON response. Confirmation is requested only when views are at least 10000.
   Require the row to remain absent after reload and the gallery original, `t/`, and `s/` files to be absent. `ImageObserver` calls `Image::deleteFiles()` for those paths.
   Separately select owned `ids[]` image checkboxes, choose **Удалить**, and click **Выполнить**. Check both database and disk deletion. Also exercise the owned detail's **Удалить** link separately from row deletion and batch deletion.

5. On **Обращения**, exercise **Открытые**, **Закрытые**, `user_id` relation filtering, and comment-count sorting. Open an owned issue through its title and require title, sender, source-page href, text, comments, and state controls.
   For an open issue, click **Закрыть** in `form[action='/acp/issues/{id}/close']`. Require **Закрыто**, an **Открыть** button, `issues.status` closed, and no comment-add form.
   Click **Открыть** in `form[action='/acp/issues/{id}/open']`. Require **Открыто**, a **Закрыть** button, and open status after reopening the detail. `canBeClosed()` requires open status. `canBeOpened()` requires closed status.
   Invalid repeated state transitions return **Обращение не может быть закрыто** or **Обращение не может быть открыто**. The normal UI swaps buttons, so do not forge a request to claim browser coverage of these rejection branches.
   If reply behavior is in scope, use only an owned open issue and its real comment form. Enter `text`, leave the `mail` honeypot blank, and click **Отправить**. Require the saved issue comment and generated local mail evidence, not real delivery.
   Delete only an owned issue through its detail and require its row to disappear. `IssueObserver` does not cascade comments or emails. Check and record any remaining owned related rows.

6. For issue batches, select only owned issue checkboxes and choose **Удалить**, then **Выполнить**. Require actual row absence before passing the action.
   The current UI sends `ids[]`, but `IssuesController::batch()` reads `selected`. A reload with zero deletions is a failure, not success. Preserve network and SQL evidence of the mismatch.
   The controller also supports `action=close` for open issues and `action=open` for closed issues, with an affected-row message. Neither action appears in the current issue batch selector.
   Report both batch state actions as uncovered by the browser UI. Do not add options, call fetch, or rename fields in the DOM to manufacture coverage. Successful single-issue state buttons do not prove batch state changes.

7. On **Магнеты**, search with `input[name='q']` and exercise **Скрытые**, **Удаленные**, and author filtering. Check views, clicks, and comment-count sorting with real linked rows.
   Open an owned magnet and **Редактирование**. Select a real leaf `categoryId` in **Рубрика**, fill unique required `rtoId`, choose `status`, and edit `relatedQuery`. Click **Сохранить**, reopen, and compare `magnets.category_id`, `rto_id`, `status`, and `related_query`.
   The edit form does not change the magnet title, hash, description, or author. **Удаленные** is a persisted `MagnetStatus`, not evidence that a row has been physically deleted.
   Open the detail's **Связанные раздачи** links when `related_query` matches other records. Follow the author sidebar and comments relation. Missing related magnets fail that specific prerequisite rather than passing an empty section.
   The **Заменить раздачу после удаления** form uses `wire:model='input'`, placeholder **Ссылка или инфо-хэш**, and **Применить**. Inspect `MagnetReplaceForm` and `UpdateMagnetAction` before driving it.
   Replacement requires an explicitly approved external request, usable Rutracker access, a valid topic, and an owned magnet. On approval, submit through the UI and verify the resulting topic ID, title, hash, size, HTML when changed, and published status. Record unavailable-service errors as failures.
   Delete only an owned magnet through **Удалить** and confirmation. Require its row and owned comments to disappear. `MagnetObserver` removes comments before deletion and invalidates cached magnet lists.

## Gotchas

- Read `routes/acp.php`, `app/Http/Controllers/Acp/{ChatMessages,Comments,Images,Issues,Magnets}Controller.php`, and `IssueCloseController.php` and `IssueOpenController.php` for the declared actions. The route group, not the extra action methods, provides their common admin gate.
- Form sources are `app/Livewire/Acp/{ChatMessage,Comment,Magnet}Form.php` and `resources/views/livewire/acp/`. The browser uses Livewire submits rather than missing resource update routes.
- `resources/views/acp/issues/index.blade.php`, `resources/views/acp/tpl/batch.blade.php`, and `resources/js/batch-form.js` establish the issue batch mismatch. Keep this gap visible until the application changes.
- `CommentObserver` and `NotifyUsersAboutComment` can send issue, news, trip, and magnet notifications when a pending comment becomes published. Local log-mail generation does not authorize external messaging.
- `ImageSeeder` creates synthetic gallery images. Those can prove gallery management, not recognition or availability of real travel photos. `Photo` and `Image` are separate models and storage paths.
- `images.type` is read into view data but does not filter the controller query. Do not claim type filtering from an unchanged list.
- `touch` compares the update year with a year cutoff, not an exact elapsed duration. Record actual row dates instead of asserting a day-level threshold.
- `ResponseToDestroyAction` returns JSON with a redirect. Batch JavaScript ignores response content. Check saved state independently even when navigation looks successful.
- No test of a shared seed object is permission to delete it. Missing owned fixtures, an unreachable external service, or an action with no browser control must remain explicit failures or uncovered actions in the report.
