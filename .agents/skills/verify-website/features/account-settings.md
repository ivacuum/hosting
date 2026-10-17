# Account settings

Verify account navigation, password changes, notification preferences, and the Telegram boundary for the current user.

## Sub-features

- `settings-home` covers authenticated GET `/my` and navigation shared by account pages.
- `settings-password` covers GET and PUT `/my/password`, including the signed-in recovery POST to `/auth/password/remind`.
- `settings-preferences` covers GET and PUT `/my/settings` with ordinary-user and root-only controls.
- `settings-telegram` maps authenticated GET `/my/link-telegram` and the rendered but unrouted `/my/unlink-telegram` link.

## How to get to it (user POV)

- Open **Аккаунт** from the signed-in desktop user menu or **Профиль** from the mobile bottom tab, both entering `/my/profile`.
- Select **Пароль**, **Настройки**, **Профиль**, or **Поездки** in the desktop sidebar or the narrow-screen account select.
- Bookmark `/my`, `/my/password`, or `/my/settings` separately. `/my` renders the account navigation without additional content.
- On `/my/password`, **Забыли пароль?** precedes **Начать восстановление** when the user has a password.
- Root sees **Открыть Телеграм** at `/my/link-telegram`, or **Отвязать аккаунт** at `/my/unlink-telegram` when already linked.
- Enter `/.well-known/change-password` through a password manager. Its redirect is mapped in [authentication](authentication.md).
- Repeat locale entry through `/en/my`, `/en/my/password`, `/en/my/settings`, and footer language links when localization is in scope.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated instance and the run's Safari tab. Sign in as `guest@example.com` with `top-secret` through [authentication](authentication.md).
- Record `SELECT id,email,locale,magnet_short_title,notification_delivery_method,telegram_id,password_changed_at FROM users WHERE email='guest@example.com'` through the isolated SQL helper.
- Use root only for the explicitly root-only preference inspection. Do not link a real Telegram account or follow a Telegram redirect.
- Extract fresh Safari UIDs before each action. Capture form state, submitted browser actions, saved feedback, and reopened state.

1. While anonymous, enter `/my`, `/my/password`, `/my/settings`, and `/my/link-telegram` separately. Require the login gate before any mutation or Telegram redirect.
2. Sign in and open `/my`. Require the shared sidebar or mobile select and no invented dashboard content.
3. Click **Пароль**. In `form[action='/my/password']`, fill **Текущий пароль** `password` incorrectly and **Новый пароль** `new_password` with at least eight characters.
4. Click **Сохранить изменения**. Require **Неверно введен текущий пароль** and unchanged `password_changed_at`.
5. Repeat with the correct current password. Require **Изменения сохранены**, a changed timestamp, and access after reopening `/my/password`.
6. Log out and require a fresh login with the new password. Restore the original password through the same UI if later journeys reuse this instance.
7. Click **Начать восстановление** in the separate recovery form. Preserve its hidden `email`. Require generated reset log mail and follow [authentication](authentication.md) if testing the reset itself.
8. Click **Настройки**. Toggle `magnet_short_title` labelled **Короткие названия раздач**. Under **Язык уведомлений**, select `locale` value `ru` for **Русский** or `en` for **Английский**.
9. Save and require **Изменения сохранены**. Reopen the page and compare checked controls with SQL `locale` and `magnet_short_title` for the same user.
10. Require root-only delivery and Telegram controls to be absent for guest. Capture `notification_delivery_method` before and after saving because the request defaults an omitted value to disabled.
11. In a separate root-only check, sign in as `root@example.com`. Inspect **Способ доставки уведомлений** with `notification_delivery_method` values `0` for **Не уведомлять**, `1` for **Электронная почта**, and disabled `2` for **Телеграм**.
12. If delivery preference mutation is in scope, save `0` or `1`, reopen, and compare SQL. Do not enable Telegram by editing DOM or submitting hidden values.
13. Inspect the Telegram link href only. Record `/my/link-telegram` as blocked for authenticated driving because it creates or reuses a `link_requests` row and redirects to `https://t.me/<configured bot>?start=<actual token>`.
14. If an existing linked root renders **Отвязать аккаунт**, record the `/my/unlink-telegram` route gap. Do not invent an unlink endpoint or modify linkage through SQL.

## Gotchas

- Source anchors are `routes/web.php`, `resources/views/my/`, `app/Http/Controllers/MyPasswordController.php`, `MySettingsController.php`, `MyLinkTelegramController.php`, and their form requests.
- Passwordless accounts omit `password` and expose only `new_password`. `social@example.com` is a seeded passwordless identity, not a usable local password login.
- Password changes regenerate the current session but do not log out other devices. Do not claim cross-device revocation.
- Notification locale changes the user's notification preference, not necessarily the current page language. Telegram's delivery radio stays disabled even for a linked user.
- `GenerateLinkRequestAction` keys requests by `user_id` and reuses an existing token. Successful bot linkage needs external bot configuration and a real conversation, both excluded here.
- The unlink link has no matching web route. Record a source-confirmed gap, not a successful unlink journey.
- Use [account profile](account-profile.md) for login/email/avatar changes and [personal trips](personal-trips.md) for the **Поездки** tab.
