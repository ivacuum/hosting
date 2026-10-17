# Feedback, comments, and typo reports

Verify feedback persistence, public discussion publication, email confirmation, and the selected-text typo shortcut.

## Sub-features

- `feedback-contact` submits the public `/contact` form.
- `feedback-embedded` submits contextual forms with a fixed hidden topic.
- `comments-submit` posts authenticated comments or anonymous pending comments through their parent page.
- `comments-confirm` follows the actual email link to `GET /comments/{comment}/confirm` and checks ownership.
- `typo-report` selects page text and uses Ctrl+Enter to send `POST /js/typo`.

## How to get to it (user POV)

- Click footer `Обратная связь` to `/contact`, or open `/contact` directly. `/privacy-policy` links to `форму обратной связи`; `/docs/trips` links through `специальная форма`.
- Embedded forms sit beneath `Обратная связь` at `/japanese/hiragana-katakana`, `/korean/hangul`, `/trainers/numbers`, `/magnets/faq`, `/photos/faq`, `/dc/faq`, `/dc/hubs`, `/promocodes-coupons/airbnb`, and `/promocodes-coupons/drimsim`.
- DC++ client articles also embed the form through their shared software template. Cover `/dc/airdc`, `/dc/apexdc`, `/dc/dcpp`, `/dc/flylinkdc`, `/dc/greylinkdc`, `/dc/jucydc`, `/dc/kalugadc`, `/dc/pelinkdc`, `/dc/shakespeer`, and `/dc/strongdc` as distinct parent paths.
- On a commentable trip, news item, magnet, or permitted issue page, scroll to `Обсуждение` and `#comment-add`.
- Use a comment feed's `#comment-{id}` link or a copied parent-page anchor as alternate discussion entries. The magnet feed is `/magnets/comments`.
- An anonymous submission's logged email contains the confirmation link. Follow that actual signed mail link rather than constructing a confirmation URL.
- Typo reporting has no separate page or form. Select visible prose on a normally visited page and press Ctrl+Enter outside form fields.
- Repeat `/en/contact`, the footer locale switch, and English parent-page forms separately when localization is in scope.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated instance with `MAIL_MAILER=log`, synchronous queues, and the standard guest account. Use disposable local-only addresses, never a real visitor's address.
- Inspect Telegram boundaries before feedback, typo reports, or comment publication. `TelegramAdminChannel` reads the integer `services.telegram.admin_id` through `Config::TelegramAdminId`. Require a valid safe value and inspect its guard; local mode alone does not suppress sending.
- Require configured outbound destinations absent or separately authorized. Log mail proves generation, not actual delivery.
- Choose a parent whose real `canBeCommented()` permits posting. Require a pending comment owned by the test user for confirmation checks, created through the form if none exists.
- Discover Safari selection, modified-key, and alert capabilities. If it cannot make a real user text selection or press Ctrl+Enter, mark the typo journey BLOCKED. Never set `window.getSelection()` or call `fetch` to simulate it.

1. Follow each contact entry independently. Require `Обратная связь`, `Ваше имя`, `Электронная почта`, `Тема`, `Текст сообщения`, and `Отправить сообщение`.
2. Submit missing required content and require browser/server validation without an issue row. Enter a one-word message to exercise the two-word server rule, then correct it.
3. Fill the real fields by their placeholders and `textarea[name=text]`. Keep the hidden `wire:model="mail"` field empty. Use a unique multiword message under 1000 characters and click `Отправить сообщение`.
4. Require `Ваше сообщение принято. Мы постараемся отреагировать на него как можно скорее.` and a cleared message textarea. Verify an Open `issues` row with the exact name, email, title, text, parent path/query, and linked user using read-only SQL.
5. For anonymous feedback, verify the matching user was reused or created by email. For signed-in feedback, require the row linked to guest even if the visible email field is edited. Do not infer owner identity from the typed email.
6. On each embedded form, require the title field absent and the email/message inputs present. The name field is also present except on `/dc/hubs`, which intentionally hides it. Submit a distinct message for every claimed parent path and verify both its stored topic and page path. Expected topics are `Hiragana Katakana Trainer`, `Hangul Trainer`, `Number Trainer`, `Magnets FAQ`, `Photos FAQ`, `DC++ FAQ`, `DC++ Hubs`, `Airbnb`, and `Drimsim` for the corresponding entries above. Every listed DC++ client article uses topic `DC++ Client`; the stored page must still distinguish the client route.
7. Respect flood/rate limits between successful submissions. Record their actual validation messages; do not clear cache or disable limits to manufacture success.
8. Sign in as guest and verify `/my/profile`. Open the chosen commentable parent, type a unique sentence in `Оставьте комментарий...`, and click `Отправить`.
9. Require the new text and current author under `Обсуждение`, a cleared textarea, and an increased published-comment count. Reload the parent and require the same anchored comment.
10. Verify the `comments` row's Published status, escaped HTML where applicable, `user_id`, `rel_type`, and `rel_id`. For a magnet, also require the new comment through `/magnets/comments` and its matching parent anchor.
11. Sign out, reload the parent, and require the email field and social-login alternatives. Enter guest's local seeded email and a different unique sentence, then click `Отправить`.
12. Require `Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.` The pending text must not appear in the public discussion after reload.
13. Verify the Pending comment, its owner, and its parent in SQL. Find the generated `Подтверждение публикации комментария` email in the copied app's mail log and preserve a redacted record of its target.
14. Within one day of generation, follow the email's actual signed mail link in the run's Safari tab. Require the resulting comment owner identity and redirect to the parent `#comment-{id}`. Require the comment now visible and Published in SQL.
15. Reopen the same confirmation link or authenticated confirmation URL. Require `Комментарий уже активирован.` with no duplicate comment. Test the direct `/comments/{id}/confirm` bookmark anonymously for the login gate and as a different seeded account for denial.
16. On an ordinary prose page, select 3 through 200 characters through actual browser interactions and press Ctrl+Enter on key release. Require the `/js/typo` POST and alert `Спасибо за информацию об ошибке` with HTTP 201.
17. Record the request's selected text and the visited page. `TypoStoreForm` derives the page from session history, not a client-supplied `page` field.
18. Select more than 200 characters and repeat. Require `Selection is too long` and no POST. A selection shorter than three characters must send no request.
19. Save before/action/after form states, final discussion anchors, read-only row evidence, redacted mail evidence, request responses, and alerts. Typo reports create an event/notification, not an `issues` row.

## Gotchas

- Feedback and comments can create a user for an unknown email. Use known local test addresses unless automatic registration itself is under test.
- Do not fill honeypots, mutate component state, or post behind the form. A successful direct HTTP request is not Safari proof.
- Comment confirmation is authenticated and owner-authorized. The signed mail wrapper can establish the recipient session; a copied bare confirmation URL is a different path.
- Issues use different comment escaping from public trip/news/magnet comments. Test each parent type claimed, rather than applying one successful magnet assertion to all models.
- OAuth alternatives leave the local app and need separate authorization. Their presence does not verify social sign-in.
- Typo notification generation is not mail and has no durable issue record. A success alert alone does not prove Telegram delivery.
- Each embedded feedback parent is a separate entry point even when it shares the same component. One successful `/contact` submission does not verify fixed topics, hidden-name variants, or the captured parent path.
- Source pointers are `routes/web.php`, `resources/views/{base,issues/create}.blade.php`, `resources/views/livewire/{feedback-form,comment-add-form,comments}.blade.php`, `app/Livewire/{FeedbackForm,CommentAddForm,Comments}.php`, `app/Http/Controllers/{CommentConfirmController,JsTypoController,MailController}.php`, `app/Http/Requests/TypoStoreForm.php`, `app/Policies/CommentPolicy.php`, `app/{Observers/CommentObserver,Mail/CommentConfirmMail}.php`, `resources/js/shortcuts.js`, and the issue/comment rate limiters.
