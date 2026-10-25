# Account profile

A visitor signs in with a password, updates their public login, sees the saved identity after reopening the page, and signs out without leaving protected pages accessible.

## Sub-features

- `account-gate`: anonymous `/my/profile` redirects to sign-in.
- `account-login`: valid seeded credentials establish a real browser session.
- `account-edit`: saving a new login changes the form, database, and public profile.
- `account-email`: saving an unused email changes the current user's record without a separate confirmation step.
- `account-avatar`: selecting a JPEG or PNG automatically saves an avatar; removing it restores the generated initial.
- `account-logout`: signing out revokes access to the protected form.

## How to get to it (user POV)

- Desktop header `Войти` or mobile bottom sign-in tab, both linking to `/auth/login`.
- Bookmark `/my/profile` while anonymous, then complete the sign-in form.
- Once signed in, user menu `Аккаунт`, or mobile `Профиль`, links to `/my/profile`; `Просмотреть профиль` opens the public view.
- The account sidebar and mobile select offer **Профиль**. Your numeric `/users/{id}` page offers **Редактировать профиль**; `/docs/trips` also links **в профиле** here.
- English counterparts live at `/en/auth/login` and `/en/my/profile`; use footer `In English` / `По-русски` to switch.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready; tab is anonymous. `guest@example.com` exists with password `top-secret`, and no user is named `verification-guest`.
- Save SQL before the mutation: `scripts/control.php sql "$VERIFY_RUN" "SELECT id, login, email FROM users WHERE email = 'guest@example.com'"` using the full skill-local helper path.
- For avatar coverage, require an operator-approved local JPEG or PNG of at most 3072 KB and an available Safari file-selection action. If file selection is unsupported, mark upload blocked rather than simulating Livewire state.

- **Gate.** Navigate to the manifest origin plus `/my/profile`. Extract the page and require the resulting route `/auth/login`, the password form, and no editable profile form. Capture `gate.txt`.
- **Menu entry.** Separately open `/`, click the visible `/auth/login` link, and require the same sign-in form. Cover desktop and mobile separately when responsive behavior is in scope; do not claim one proves the other.
- **Sign in.** From fresh extracted UIDs, type `guest@example.com` into `form[action='/auth/login'] input[name='email']`, type `top-secret` into `input[name='password']`, and click its `Войти` button. Leave hidden `mail` blank. Record the action; require an authenticated header and successful navigation, then open `/my/profile` through the profile link or bookmarked entry being checked. Capture the pre-edit form.
- **Edit.** In `form[action='/my/profile']`, replace `input[name='username']` with `verification-guest`; leave email unchanged. Click `Сохранить изменения`. Require `Изменения сохранены` and the new login. Save the action transcript, extracted after-state, and screenshot.
- **Persistence.** Navigate away, reopen `/my/profile`, and require the input still contains `verification-guest`. Click `Просмотреть профиль`; require the public user route `/users/2` for the standard seeded guest and visible identity `verification-guest`. Save read-only SQL showing the same login for `guest@example.com`. A flash message alone does not prove persistence.
- **Email.** Record the current user ID, then replace `email` with an unused disposable address through the same form. Save and reopen. Require the new value and SQL for that ID. Restore the original email through the UI before later login checks. No verification-mail step is implemented by this controller.
- **Validation.** Try an existing seeded email or login. Require field feedback and unchanged SQL for the current user. Do not change another account to manufacture uniqueness.
- **Avatar upload.** In **Аватар**, choose the approved file through `input[type='file']` with `wire:model.live="image"`. It has a regenerated ID, not a stable name. Require the automatic preview and save after **Идет загрузка...** settles, without clicking the profile save button.
- **Avatar persistence.** Reopen the page and **Просмотреть профиль**. Require a loaded avatar image. Query `SELECT id,avatar FROM users WHERE id=<recorded user ID>` and inspect the matching file in the copied app's configured avatars disk, normally `public/uploads/avatars`. Require a 200-by-200 image, not just a nonempty filename.
- **Avatar removal.** Click **Удалить аватар**, reopen both views, and require the generated initial plus an empty SQL `avatar`. Inspect whether the old file remains and record the actual result rather than assuming observer cleanup worked.
- **Restore and logout.** Reopen `/my/profile`, restore the original login `guest` through the same form, and capture SQL restoration. Open the authenticated user menu (`header details > summary`) and click `Выход` (form action `/auth/logout`); require anonymous `Войти`. Reopen `/my/profile` and require the login redirect again. Save final state. If the journey fails midway, destroy the isolated instance instead of editing the original checkout/database.

## Gotchas

- Login and profile labels are not all programmatically associated with inputs; use the real input `name` attributes and HTML extraction when text UIDs are ambiguous.
- The hidden `mail` field is a spam trap, not the email field. Do not autofill it.
- Browser cookies and SameSite/Sec-Fetch request-origin checks are part of the path. Do not bypass them with synthetic login requests.
- GET `/my/profile` displays the form. Saving uses POST with hidden `_method=put` for PUT `/my/profile`; avatar changes use authenticated Livewire requests independently.
- See [authentication](authentication.md) for registration, recovery, and OAuth boundaries, [account settings](account-settings.md) for passwords and preferences, and [personal trips](personal-trips.md) for trip management.
- `Просмотреть профиль` uses the stable `/users/{id}` route, not the separate `/@{login}` traveler home. Do not infer that changing a login must change this link's URL.
- Blank login is allowed and public name falls back to `user #{id}`. The generated avatar uses one uppercase character of login or email, as both the Russian and English help text say.
- Avatar validation accepts only JPEG or PNG images up to 3072 KB. Conversion needs GraphicsMagick. Capture validation/conversion errors and confirm SQL remains unchanged on failure.
- Source anchors are `MyProfileController`, `MyProfileUpdateForm`, `resources/views/my/profile.blade.php`, `AvatarManager`, `resources/views/livewire/avatar-manager.blade.php`, `app/Domain/Avatar/Avatar.php`, and `UserObserver`.
