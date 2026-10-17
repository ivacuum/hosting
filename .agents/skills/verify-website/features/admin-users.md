# Admin users

Verify administrator lookup and maintenance of users, linked external identities, and recorded emails without changing shared accounts or contacting external services.

## Sub-features

- `admin-users-list` covers `GET /acp/users`, email or ID search, avatar filters, last-login filters, sorting, and related-record links.
- `admin-user-detail` covers `GET /acp/users/{id}`, avatar, JSON, and nonempty relation links.
- `admin-user-edit` covers `GET /acp/users/{id}/edit` and the Livewire save of email and activation status.
- `admin-user-delete` covers `DELETE /acp/users/{id}` and its related-record and avatar effects.
- `admin-identities` covers `GET /acp/external-identities`, provider and user filters, `GET /acp/external-identities/{id}`, and `DELETE /acp/external-identities/{id}`.
- `admin-emails` covers `GET /acp/emails`, user filtering, sorting, `GET /acp/emails/{id}`, and `DELETE /acp/emails/{id}`.
- `routes/acp.php` excludes user create and resource save routes. The controller's unused `create()` method does not make `/acp/users/create` a supported create journey.
- Identities and emails have no ACP create or edit routes. Viewing them does not prove OAuth login, message delivery, or unsubscribe behavior.

## How to get to it (user POV)

- Sign in at `/auth/login` with the isolated administrator. The user menu's **Админка** opens `/acp/dev/templates` locally. Bookmark `/acp` separately.
- Under **Сайт**, select **Пользователи** `/acp/users`, **Социальные учетки** `/acp/external-identities`, or **Письма** `/acp/emails`.
- On the users list, click a linked email to open `/acp/users/{id}`. Use **Редактирование** in the detail sidebar to open `/acp/users/{id}/edit`.
- User list counts link to `/acp/chat-messages?user_id={id}`, `/acp/comments?user_id={id}`, `/acp/images?user_id={id}`, `/acp/magnets?user_id={id}`, `/acp/trips?user_id={id}`, and `/acp/issues?user_id={id}`.
- The email count in a user list row is plain text, not a link. Use **Письма** and a bookmarked `/acp/emails?user_id={id}` for that filtered entry.
- Nonzero user-detail relation links include chat messages, comments, external identities, images, issues, magnets, and trips. They do not include emails.
- In the external-identities list, click the numeric identity ID for ACP detail. The provider icon links to the external profile, not the ACP identity page.
- Identity details with a positive `user_id` expose **Владелец**. Email details expose **Получатель** for positive `user_id`.
- Click an email list's numeric ID to inspect the recorded email. **Удалить** on these detail pages invokes the model's DELETE route with a confirmation.
- Equivalent routes exist under `/en/acp`. Record actual menu hrefs because ACP navigation contains literal Russian `/acp/...` links.

## Driving it with Safari MCP

Preconditions:

- Follow `../SKILL.md`, require doctor readiness, and use the exact manifest origin in a new Safari tab. Sign in as `root@example.com` with `top-secret` for administration only.
- `bootstrap/app.php` applies `auth` and `Admin` to all ACP routes. `User::isAdmin()` currently means `isRoot()`. `UserPolicy`, `ExternalIdentityPolicy`, and `EmailPolicy` require root for their declared operations.
- Check anonymous `/acp/users` redirects to login. Sign in as `guest@example.com` and require unauthorized access without account-management controls. Return to root before the remaining journeys.
- Preserve root ID 1, guest, and other shared seed accounts. Editing or deleting accounts and identities requires a separately created, verification-owned user and owned related rows in this disposable run.
- For deletion, inventory every relation and file before clicking. Every affected object must belong to this verification run's fixture, including nested comments and files. Do not use an administrator's account as the deletion target.
- A successful user-deletion fixture must have no remaining issues, photos, social posts, social tokens, or other foreign-key dependents outside `UserObserver`'s deletion list. Otherwise deletion can fail after some related rows have already been removed.
- `UserSeeder` provides root, guest, and magnets accounts. `ExternalIdentitySeeder` creates `social@example.com` and six linked provider identities. Use these for read-only checks, not disposable deletion targets.
- `DatabaseSeeder` calls no dedicated email seeder. Require a real local `emails` row with a valid user before email detail and deletion checks. An empty list does not prove those actions.
- Existing local mail-generating workflows may provide an owned email fixture only with a confirmed log mailer and disposable recipient. Real messages, OAuth, provider revocation, or external-account changes require explicit approval.
- Missing owned users, identities, emails, avatars, or populated relations fail their journeys. Do not silently switch to root or manufacture fixtures with synthetic requests or component calls.
- Save redacted before/action/after text, screenshots, browser actions, and run-scoped SQL in `evidence/admin-users/`. Use `control.php sql` from the skill for read-only persistence checks. Do not expose tokens, credentials, or personal email data in shared artifacts.
- Discover Safari signatures and use fresh extracted UIDs with `page_interactions`. User edit fields are bound with `wire:model`, not ordinary named form parameters. Do not set Livewire properties through JavaScript.

1. Open **Пользователи** through **Сайт** and record rows, total, and pagination. Search a known user with `input[name='q']` and submit with Enter. Numeric input searches exact ID. Other input searches email substrings, not login names.
   Exercise **Неделя** and **Месяц**, which set `last_login_at=P1W` and `P1M`. Compare visible timestamps with the actual run date. Use **Есть** and **Нет** for `avatar=1` and `avatar=0`, then reset the filters.
   Click a last-login or related-count sortable header. Require the changed `sk` query and matching row order. An avatar filter with no matching rows needs a real fixture before avatar rendering can pass.

2. Open a read-only seeded user by its email, expand **JSON**, and check the displayed identity against the list row. Inspect the avatar's actual URL and load state if one exists.
   Follow each available nonzero relation link and require the correct resource and `user_id`. Record which relation fixtures are missing. A successful comments link does not prove image, issue, or identity links.
   Return to the list and independently follow its chat, comment, image, magnet, trip, and issue counts. These list entries are separate from the detail-sidebar entry paths.

3. Open an owned user's **Редактирование** page. Locate `wire:model='email'` and the `status` radio group. Keep the account's password and login out of scope because this form exposes neither.
   Replace the email with a unique, syntactically valid verification address. Select **Не активирован**, click **Сохранить**, and require return to `/acp/users` unless the existing `goto` return target applies.
   Reopen `/acp/users/{id}/edit` and require the saved email and inactive status. Compare `users.email` and `users.status` with run-scoped SQL. Repeat with **Активирован** to verify the owned account can be activated again.
   If checking validation, use another owned user's email and require the uniqueness error without changing the saved row. Never test collisions by changing root's email.

4. Open **Социальные учетки** and exercise **ВК**, **Гитхаб**, **Гугл**, **Твиттер**, **Фэйсбук**, and **Яндекс**. Require the matching provider values and identity IDs after each filter.
   Follow a populated user-detail identity relation to `/acp/external-identities?user_id={id}`. Require only that user's rows. Without `user_id`, the controller excludes identities with `user_id=0`. An explicit zero filter is a different bookmarked entry.
   Click an identity ID, expand **JSON**, and compare provider and user association with the list. Follow **Владелец** and require the correct `/acp/users/{id}`. Keep provider tokens out of screenshots and transcripts.
   On a separate owned identity, click **Удалить** and accept **Запись будет удалена. Продолжить?**. Require its `external_identities` row to disappear and its local user to remain.
   The action deletes the local association. It does not revoke provider tokens, delete a provider account, or prove a subsequent OAuth login. Do not click the external profile icon as a substitute for an ACP detail check.

5. Open **Письма** and require actual rows showing template, relation type and ID, locale, recipient, views, clicks, and creation time. Exercise view and click sortable headers with real counts.
   Independently bookmark `/acp/emails?user_id={owned-user-id}` and require only that recipient's rows. The user-list email count does not navigate here.
   Click an email ID and inspect the detail's **JSON**. This generic detail does not render the message body or resend the email. Follow **Получатель** and require the associated user.
   Delete only an owned email record through **Удалить** and confirmation. Require its `emails` row to disappear while the user remains. Existing log-mail files are separate evidence and are not erased by `EmailObserver`.

6. Before deleting an owned user, save its ID, avatar path, and related IDs. Verify no root or shared object appears in the dependency inventory.
   On `/acp/users/{owned-id}`, click **Удалить** and confirm. Require return to `/acp/users`, absent user search results, and absent `users` row.
   `UserObserver` deletes chat messages, comments, emails, external identities, images, magnets, news, received emails, and trips through their model deletion methods. Verify the owned dependent rows and image files disappear where those observers require it.
   The observer also removes the avatar file when one exists. It does not explicitly delete issues or trip photos. Their user foreign keys can prevent user deletion. Record the error and any partial effects rather than claiming a complete cascade.
   Do not clean unexpected leftovers by broad database or filesystem deletion. Preserve evidence, report the mismatch, and use only the isolated-run teardown from the skill.

## Gotchas

- Source pointers are `routes/acp.php`, `app/Http/Controllers/Acp/{Users,ExternalIdentities,Emails}Controller.php`, `app/Livewire/Acp/UserForm.php`, and `resources/views/acp/{users,external-identities,emails}/`.
- `resources/views/livewire/acp/user-form.blade.php` exposes only email and activation status. This is not the personal profile form and cannot edit login, password, root privileges, or avatar.
- `GetModelAccessibleRelationsAction` suppresses zero-count or unauthorized relation links. An absent link on an empty fixture is not coverage of the relation journey.
- `UserObserver::deleting()` performs nested model deletions. `ImageObserver`, `MagnetObserver`, `NewsObserver`, and `TripObserver` add file or comment side effects. Inventory those effects before authorizing the user deletion click.
- `ExternalIdentitySeeder` provides linked identities, not an unlinked `user_id=0` example. The mail and avatar prerequisites may also be absent. Report these seed gaps instead of weakening the assertions.
- Generic **JSON** details can contain sensitive fields. Capture only redacted evidence. OAuth provider links and generated mail tracking links can contact external systems and are not required for these ACP record checks.
- No new test code is required for a map-only change. These recipes describe intended browser coverage and do not assert that a browser drive has already passed.
