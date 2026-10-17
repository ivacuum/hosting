# Mail archive

Verify generated mail links, tracking responses, and recipient ownership without sending real mail or Telegram notifications.

## Sub-features

- `mail-view` covers GET `/mail/view/{timestamp}/{id}`, a tracking-image response rather than a rendered archive page.
- `mail-click` covers GET `/mail/click/{timestamp}/{id}`, signed redirects, recent-mail auto-login, and unsigned same-origin destinations.
- `mail-report` covers authenticated GET `/mail/report/{timestamp}/{id}` with matching timestamp and recipient ownership.
- `mail-generation` connects actual log-mail links with persisted `emails` records. Password-reset mail is a separate untracked message type.

## How to get to it (user POV)

- Open a message produced by a real browser action in this isolated run, or use a real existing valid record and its preserved generated URL.
- To generate tracked mail, post anonymously in a published story's `#comment-add` form. Its pending comment generates confirmation mail rather than publishing immediately.
- A comment-confirmation message offers **Опубликовать комментарий** and **Это не я**. The latter is a signed click link to the report route.
- A tracked message contains a one-pixel image pointing to `/mail/view/{timestamp}/{id}`. It is not a user-facing **Просмотреть письмо** page.
- A saved signed click URL is a bookmarked entry. Preserve its actual `goto`, timestamp, ID, signature, and expiration without editing the origin.
- There is no public mail archive index or site menu link. Administrative mail pages are a separate scope.
- Message locale controls its button text. English **It was not me** is the counterpart of **Это не я**.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated instance, `MAIL_MAILER=log`, synchronous queues, and the run's own Safari tab.
- Query `SELECT id,user_id,template,clicks,views,created_at FROM emails ORDER BY id DESC LIMIT 20` through the isolated SQL helper.
- Require actual tracked mail generated through a browser journey, or a valid existing record plus its real signed link. Seeders do not guarantee tracked `emails` rows.
- If no tracked message exists, mark signed-click, tracking, and report journeys blocked. Do not manufacture IDs, timestamps, signatures, reset tokens, or SQL fixtures.
- Before a report, inspect the copied runtime configuration and require `services.telegram.admin_id` to be null. A configured admin permits a real external Telegram send even in local mode, so block the action otherwise.

1. On a real published story, remain anonymous and fill **Электронная почта** `wire:model="email"` with `guest@example.com`. Fill **Оставьте комментарий...** `wire:model="text"` with a short readable verification message, then click **Отправить**. Leave hidden `mail` blank.
2. Require **Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.** and a matching pending comment and `CommentConfirmMail` row. Capture the redacted generated mail from the copied app's `storage/logs`. Do not click **Опубликовать комментарий** in this bounded journey.
3. Extract the actual tracking-image URL and open it in the run's Safari tab. Require a 204 response and no mail-content page. Capture network status, not an unchanged previous page screenshot as success.
4. Compare the URL's timestamp with the record's `created_at` formatted as `YmdHis`. A valid timestamp emits `MailViewed`; immediate `emails.views` need not change before metrics aggregation.
5. Open the preserved signed click URL from log mail only after the report safety check if it targets reporting. Require its real `goto` destination and an incremented `emails.clicks` for a matching timestamp.
6. For an actual message less than one day old and owned by a test user, start anonymous before opening its signed link. Require auto-login to that recipient and activation if previously inactive.
7. Confirm identity through `/my/profile` and SQL ownership. A preexisting browser session for another user can be replaced by the recent-mail click path.
8. For a real message older than one day, repeat only if such data exists. Require the redirect without asserting recent-mail auto-login. Do not age records through SQL.
9. For a real mail route, open an unsigned copy with a same-origin `goto`, removing the signature rather than inventing one. Require the redirect and unchanged clicks and browser identity.
10. Check unsigned off-origin `goto` rejection only with a controlled destination and no external navigation. Require 403, not an outbound redirect.
11. If the message supplies **Это не я**, preserve its complete signed URL. With the Telegram safety precondition met, open it through Safari and require the recipient session, home redirect, and **Спасибо за информацию о письме. Мы проверим ее.**
12. Separately open its actual report URL anonymously. Require the auth gate. Sign in as a different seeded user and require 404 for that recipient-owned record.
13. Capture SQL `user_id`, `clicks`, and `views` before and after. Reporting fires `MailReported` and does not create an unsubscribe or report-status field in this controller.
14. If the run has no browser-generated tracked message, use [authentication](authentication.md) only to prove reset-mail generation. Record that this does not satisfy the tracked-mail prerequisite.
15. Save before/action/after extracts, network results, redacted log excerpts, and SQL under `evidence/mail-archive/`. Never publish the usable auto-login link.

## Gotchas

- Source anchors are `MailController`, `MailClickForm`, `app/Email.php`, `app/Mail/RecordsEmail.php`, `resources/views/emails/comment-confirm.blade.php`, and `resources/views/vendor/mail/html/hit.blade.php`.
- A view request returns 204 even when its row or timestamp is invalid. A 204 alone does not prove a valid tracked view.
- Valid signatures permit arbitrary signed destinations. Unsigned `goto` must match the current scheme, host, and port. Never turn this verification into an external click journey.
- Signed clicks increment clicks only for matching timestamps. The recent-mail login branch is separate from that timestamp check, so do not claim timestamp mismatch prevents all login effects.
- Report requires both matching timestamp and current recipient ownership. The timestamp is not an authentication token.
- `TelegramMailReport` calls `Telegram::notifyAdmin`, which dispatches whenever an admin chat ID exists. Local mode only adds a text prefix, not a send prohibition.
- Metrics use the wildcard stream and deferred aggregation. No scheduler runs in the helper stack. Do not run processing or infer immediate `views` updates here.
- `ResetPasswordMail` has no `RecordsEmail` trait and no tracking image. A successful password reminder does not create evidence for this map's tracked routes.
