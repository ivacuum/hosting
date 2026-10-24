# Magnets

Verify published release discovery, search, personal releases, additions, download accounting, release requests, and discussions.

## Sub-features

- `magnets-discover` browses `/magnets`, category links, tags, related releases, and pagination.
- `magnets-search` submits `q`, filters `category_id`, and switches `fulltext`.
- `magnets-detail` opens `/magnets/{magnet}` and posts click accounting to `/magnets/{magnet}/magnet` through real magnet links.
- `magnets-add` uses `/magnets/add` and its reactive Rutracker lookup.
- `magnets-my` checks the authenticated `/magnets/my` list.
- `magnets-request` submits the search-page form to `POST /magnets/request`.
- `magnets-comments-faq` reads `/magnets/comments`, `/magnets/faq`, and detail discussions.
- `magnets-chat` posts to the authenticated chat and observes its polling, history, and scroll behavior.

## How to get to it (user POV)

- Click Russian desktop header `Магнеты` to `/magnets`, or open that URL as a bookmark. The mobile bottom bar has no magnet tab.
- Magnet tabs link to `Новые раздачи`, `Добавить`, `Помощь`, and `Комментарии`. Signed-in users also see `Мои раздачи`.
- Click the release title for details. A separate magnet icon with title `Магнет` is a `magnet:` link, not a detail link.
- Search uses `input[name=q]` with placeholder `Поиск...`. Category sidebar links add `category_id` while retaining `q`.
- Detail tag links return to `/magnets?q=...`; `Связанные раздачи` titles enter other details. Comment-feed links include `#comment-{id}`.
- After searching, expand `Не нашли искомую раздачу? Оставьте нам запрос` for the release-request form.
- FAQ `Как добавить раздачу?` contains `отдельная страница` to `/magnets/add`. The empty personal list has its own `Добавить раздачу` button.
- Open copied search, detail, and `/magnets/my` URLs separately. The section is Russian-only: every `/en/magnets*` route returns 404, its pages show no `In English` footer link or `hreflang="en"` alternate, and magnet and comment links always point to `/magnets/...`, including on `/en/torrent`.
- Anonymous visitors see `Пользователям доступен чат`. Its `Пользователям` link enters sign-in with a return destination. Chat appears at `/magnets` only when signed in and the query string is empty.

## Driving it with Safari MCP

Preconditions:

- Require doctor readiness and published seed releases. `MagnetSeeder` provides `Hunt: Showdown`, `Мир героев`, `Головоломка`, and three related Hitman releases, plus hidden/deleted records.
- Use `guest@example.com` / `top-secret` for authenticated paths and verify `/my/profile`. Seed releases belong to `magnet@example.com`, which has no seeded password. Guest's personal list starts empty.
- The isolated helper uses Scout's collection driver. It cannot prove production morphology, ranking, or title-only versus description-search semantics.
- Before add/request/comment actions, inspect Rutracker and `services.telegram.admin_id`. Both Telegram paths read that destination, but use different guards. Local mode is not a network sandbox. Require explicit external authorization before real outbound operations.
- Magnet activation can launch a system torrent client. Require permission and safe protocol handling before clicking. If Safari cannot manage the prompt, report this interaction BLOCKED rather than sending the accounting POST manually.
- Chat is a separate notification boundary. Non-root posts fire `ChatMessagePublished` and can notify the Telegram administrator. Require a safe configured notification destination and authorization before that path. Root-authored posts skip the notification listener and can verify only that explicit no-notification path.

1. Follow the header and tab entries. Require actual published release titles and sizes, not just a tab bar. Verify hidden/deleted seed records do not appear.
2. Click a populated category in the desktop sidebar and require its marked category and matching releases. Record the exact category href and count. A missing mobile sidebar is not a filter failure.
3. Enter `Hitman` in `q` and submit with Enter or the adjacent search button. Require the query heading and matching published results. Repeat through `/` keyboard focus on `.js-search-input` outside an input.
4. Click `Искать в описаниях раздач`, require `fulltext=1`, and then click `Искать только в заголовках` to remove it. Record the local driver's semantic limitation rather than claiming a description-only match.
5. Expand `Как пользоваться поиском?` and follow an actual example link. Verify its `q` and `fulltext` values. Inspect `Искать на рутрекере` as an external href without following it unless authorized.
6. Submit a nonsense query and require `Подходящих раздач не найдено.` Submit a one-character query and require normal listing behavior because queries shorter than two characters are ignored.
7. Follow available paginator links and require preserved filters. Standard seeds fit on one 25-row page; populated next-page proof requires additional authorized data and fails as a missing prerequisite otherwise.
8. Open a release title and require its rendered description in `#rutracker_post`, size, source link, and discussion. Follow a Hitman related title and a tag link as separate paths.
9. If the actual description has spoilers or images, click `.sp-head`, `[свернуть]`, and aligned images to verify expand/fold/resize behavior. Standard plain-text seed descriptions do not prove these controls or remote media.
10. Record `magnets.clicks` for one release through read-only SQL. Click its list `.js-magnet` link once through Safari and require a POST to its rendered `data-action`, HTTP 204, and a one-count persisted increment.
11. Require the visible `.js-magnet-counter` increment. Click the same element again and require no second accounting POST from that element until reload. Do not equate protocol-client completion with download-accounting success.
12. Exercise both detail `Магнет` links and a related-release magnet separately. Require their matching release IDs in accounting. Capture console errors because detail links lack the list counter child that `events.js` attempts to update.
13. Visit `/magnets/my` anonymously and require the login gate. Sign in, click `Мои раздачи`, and require guest's empty message `Вы еще не добавили ни одной раздачи.` and its add button.
14. For a populated ownership journey, complete an authorized real add as guest, then reopen `Мои раздачи`. Require the new release, counts, size, date, and source link, with `user_id` matching guest in SQL. Missing add prerequisites do not permit claiming populated ownership coverage.
15. At `/magnets/add`, type an approved real topic URL, info hash, or topic number in `Ссылка или инфо-хэш`. Wait for the actual Rutracker lookup and require its title/size preview.
16. Choose an enabled leaf option under `Выберите рубрику...`, then click `Добавить раздачу`. Require redirect to the new detail and a Published `magnets` row with the selected category, real topic ID/hash, and correct owner.
17. Verify invalid or duplicate lookup input shows its actual message and no new row. Add is also accessible anonymously; only exercise anonymous success with separate authorization for its configured anonymous owner and Telegram notification.
18. In the search release-request details, fill `input[name=query]` and optional `textarea[name=comment]`. Keep hidden `mail` empty. Click `Отправить запрос` and require the actual POST, redirect back, and `Запрос принят. Уведомления пока присылать не умеем, поэтому просим вскоре вернуться на сайт.`
19. This request sends a Telegram notification when configured and creates no release/request row. Save the safe outbound-boundary evidence separately. A local success flash does not prove notification delivery or eventual release fulfillment.
20. Open `Комментарии`, require `Последние комментарии`, and follow a published release's anchored comment link. Use [Feedback and comments](feedback-comments.md) for anonymous pending and authenticated published submissions.
21. Open `Помощь` and expand FAQ controls including `Как скачать раздачу?` and `Как добавить раздачу?`. Its feedback form has hidden title `Magnets FAQ`; verify it through the feedback map.
22. For chat, follow the anonymous `Пользователям` entry, sign in, and return to `/magnets` without `q`, category, or pagination parameters. Require `.chat-container`, date headings, author names, message text, and times. Verify Published seed messages such as `Всем привет` appear and the hidden `Неопубликованное сообщение` does not. Anonymous pages and query-filtered listings must not expose the chat form.
23. After satisfying the chat notification prerequisite, enter a unique local message in `input[placeholder='Сообщение в чат...']` inside `form[wire\:submit='post']`. Click that form's `Отправить` button or submit through the input's Enter action. Require the visible new message, current author, time, and cleared input. Reload and require the same message. Verify exact text, `user_id`, and Published status in `chat_messages` through read-only SQL. Check notification generation or root bypass separately from visible persistence.
24. Submit an empty chat input and require validation with no new message row. Open a second owned tab on the same signed-in instance, send another authorized message there, and return to the first. Keep the first tab visible for the real `wire:poll.60s` refresh. Require the second message to appear without manually refreshing or calling the component. Capture the poll response and resulting text.
25. For scroll behavior, require enough published history to overflow `.chat-container`. Observe bottom-follow when already at the bottom, then scroll upward and require the next poll not to pull the reader back down. The baseline seed may not overflow and has fewer than 20 messages. A long-history/window-size check therefore fails its fixture prerequisite until authorized browser-created history exists. Never insert rows or dispatch `ScrollChatDown` to manufacture the user path.

## Gotchas

- FAQ copy says registered users add and comment, but the real add component and email-based comment form allow guests. Assert implementation behavior, and report that copy discrepancy.
- The helper has no scheduler. Automatic six-hour source updates and external torrent completion remain unverified.
- The chat recipe does not authorize sending to a real Telegram destination. A root-only proof does not establish the non-root notification path, and a second tab sharing the same cookie is not a different-user authorization test.
- Download clicks are real writes even though the accounting response is empty. Only read-only SQL may independently check them.
- Anonymous users do not see `Мои раздачи`; the direct URL still needs an auth-gate check. Published details are Russian-only even if other magnet pages render under `/en`.
- Source pointers are `routes/web.php`, `app/Http/Controllers/{MagnetsController,MagnetRequestReleaseController}.php`, their request classes, `app/Domain/Magnet/{Livewire/MagnetAddForm,Action/SearchForMagnetIdsAction,Seeder/MagnetSeeder}.php`, `resources/views/magnets/*`, `resources/views/livewire/magnet-add-form.blade.php`, `resources/js/{events,view-magnet-post}.js`, and `app/Domain/Telegram/Action/NotifyAdminViaTelegramAction.php`.
