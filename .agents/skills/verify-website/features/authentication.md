# Authentication

Verify password sign-in, registration, recovery, and the local boundaries of external sign-in without changing external accounts.

## Sub-features

- `auth-session` covers GET and POST `/auth/login`, login by email or login, intended destinations, and POST `/auth/logout`.
- `auth-register` covers GET and POST `/auth/register`, duplicate-email recovery, and the declared GET `/auth/register/confirm/{token}` route.
- `auth-recovery` covers GET and POST `/auth/password/remind`, GET `/auth/password/reset/{token}`, and POST `/auth/password/reset`.
- `auth-oauth` maps GET `/auth/facebook`, `/auth/google`, `/auth/vk`, and each provider's `/callback` route.
- `auth-password-discovery` covers GET `/.well-known/change-password`, which redirects permanently to `/my/password`.

## How to get to it (user POV)

- Click desktop **Войти** or the mobile sign-in tab at `/auth/login`. A protected bookmark such as `/my/profile` also opens sign-in.
- On sign-in, click **Регистрация** at `/auth/register` or **Забыли пароль?** at `/auth/password/remind`.
- Use **Начать восстановление** from the reminder page or the signed-in `/my/password` recovery form.
- Open the actual reset link from generated log mail. The message button is **Сменить пароль**.
- The sign-in page offers **ВК** at `/auth/vk` and **Гугл** at `/auth/google`. Facebook has a direct route but no button here.
- Anonymous comment forms also offer **ВК** and **Гугл**. Their real `goto` returns to that page's `#comment-add`; inspect these alternate hrefs without external navigation.
- Password managers can enter through `/.well-known/change-password`. `/en` counterparts and footer language links are separate entry checks.

## Driving it with Safari MCP

Preconditions:

- Use the isolated manifest origin and a ready doctor result from [SKILL.md](../SKILL.md). Start anonymous in the run's Safari tab.
- Use seeded `guest@example.com` or login `guest` with `top-secret`. Choose an unused disposable email for registration.
- Keep `MAIL_MAILER=log` and synchronous queues. Read mail only from the copied app's `storage/logs` and redact reset URLs from shared evidence.
- Use fresh `get_page_content` UIDs and `page_interactions`. Save before/action/after evidence and read-only SQL through the run's helper.

1. Follow a header sign-in link, then separately enter a protected bookmark. Fill `email` and `password` in `form[action='/auth/login']` and click **Войти**. Leave hidden `mail` empty.
2. Require the intended protected page and authenticated identity. Repeat after logout with `guest` in `email` to prove login-name access separately.
3. Inspect **Показать пароль**, **Скрыть пароль**, and checkbox `foreign` labelled **Не запоминать меня** through browser actions. Unticked sign-in should set a `remember_web_*` cookie and ticked sign-in only the session cookie. A failed login keeps the checkbox state.
4. Submit one wrong password. Require **Электронная почта, логин или пароль неверны**, retained `email`, and no protected access.
5. Click **Регистрация**. Fill `email` and `password` of at least eight characters, then **Зарегистрироваться**. Require home navigation and an authenticated account.
6. Query `SELECT id,email,login,status,activation_token FROM users WHERE email = '<registered email>'`. Require an active account with cleared activation token, not a pending confirmation screen.
7. Log out and register the same email again. Require the duplicate-email recovery message and an actual reset message in log mail. Require no second user row.
8. Follow **Забыли пароль?**, submit `email` with **Начать восстановление**, and require feedback plus generated mail. Inspect `password_reset_tokens` for that email without publishing its token hash.
9. Open the exact browser-generated mail URL at this run's origin. Fill reset `email` and `password`, preserve hidden `token`, and click **Сменить пароль**. Require authenticated home navigation and a changed `users.password_changed_at`.
10. Log out and sign in with the new password. Require the old password to fail and the reset-token row to disappear after success. Never invent a reset token or derive one from its database hash.
11. Enter `/.well-known/change-password` anonymously and signed in. Capture the 301 to `/my/password`, then the login gate or password form respectively.
12. Inspect sign-in and comment-form provider hrefs without leaving the instance. For each local callback, a bookmarked `?error=access_denied` must return to sign-in. Compare `SELECT id,user_id,provider,uid FROM external_identities ORDER BY id` before and after to require no identity changes.
13. Record the confirmation route as blocked. `NewAccount` has no `confirm` method, registration clears its token, and no confirmation message supplies a valid URL. Do not fabricate one.
14. Sign out through **Выход** and its `/auth/logout` form. Require anonymous navigation and a protected-page redirect. See [account profile](account-profile.md) for the complete edit journey.

## Gotchas

- Source anchors are `routes/web.php`, `app/Http/Controllers/Auth/`, `app/Http/Requests/Auth/`, `resources/views/auth/`, `app/User.php`, and `app/Mail/ResetPasswordMail.php`.
- Registration currently activates and logs in immediately. Do not describe its declared confirmation endpoint as a working email-verification flow.
- `SignInForm` sets `remember` to the inverse of `foreign`, so **Не запоминать меня** controls the remember-me cookie. That cookie is HTTP-only, so `document.cookie` cannot show it; record the cookie check as NOT_VERIFIED unless the harness exposes response headers or a cookie store.
- OAuth success requires configured provider credentials, a valid browser state and callback code, and an authorized test account. It is blocked here because real external writes are prohibited.
- Successful callbacks can create or attach `external_identities` by provider UID and email, activate users, and log them in. Seeded `social@example.com` identities are fixtures, not usable provider credentials.
- Facebook supports `rerequest=1`, VK supports `revoke=1`, and all three starts accept `goto`. Missing-email Facebook and VK feedback links retry with those flags. Inspect only, without external navigation.
- The reminder POST also works while signed in, although its GET page is guest-only. Reset forms contain no password-confirmation input and do not prefill email from the mail URL.
- Log mail proves message generation, not delivery. Throttling and infrastructure fields remain part of the browser path. Never submit synthetic forms to bypass them.
