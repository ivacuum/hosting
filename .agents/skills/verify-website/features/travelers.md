# Travelers

Verify public numeric user profiles and login-based travel pages as distinct destinations, including their discovery links and publication boundaries.

## Sub-features

- `users-directory` covers GET `/users` and GET `/users/{user}` with numeric model IDs.
- `traveler-home` covers GET `/@{traveler:login}` and GET `/@{traveler:login}/travel`, including `from` and `to` date filters.
- `traveler-cities` covers GET `/@{traveler:login}/travel/cities` and `/@{traveler:login}/travel/cities/{CityCached}`.
- `traveler-countries` covers GET `/@{traveler:login}/travel/countries` and `/@{traveler:login}/travel/countries/{CountryCached}`.
- `traveler-story` covers GET `/@{traveler:login}/travel/{slug}` and GET `/trips/{trip}`, including its optional `anchor` query.

## How to get to it (user POV)

- Bookmark `/users`. Click a row's avatar or **Псевдоним** link to `/users/{id}`. The directory also shows **ID** and **Дата регистрации**.
- **Просмотреть профиль** on `/my/profile` opens that numeric profile. An owner sees **Редактировать профиль** back to `/my/profile`.
- Enter a known `/@{login}` bookmark or click **Просмотреть** in `/my/trips` to enter `/@{login}/travel`.
- Travel navigation offers **По годам**, **По странам**, and **По городам**. Country and city names enter their matching detail routes when published trips exist.
- Year-list story links, city timelines, country lists, breadcrumbs, and adjacent-trip timelines provide alternate story entries.
- `/trips/{id}` is a numeric redirect entry, not the same route as `/users/{id}`. Root-owned trips redirect to `/life/{slug}`.
- Repeat `/en/users`, `/en/@{login}/travel`, and actual footer language-switch links separately when localization is in scope.

## Driving it with Safari MCP

Preconditions:

- Use a ready isolated instance in an anonymous Safari tab. Public browsing needs no login.
- Read `SELECT id,login,status FROM users ORDER BY id` and `SELECT id,user_id,city_id,slug,status,date_start FROM trips ORDER BY id` through the run's SQL helper.
- Seeders supply root stories and a `trip` traveler with a random city. Select actual rows and rendered links, not assumed IDs or slugs.
- Use [personal trips](personal-trips.md) to create missing ordinary-owner publication variants through the UI. Record a data gap if required variants are unavailable.

1. Open `/users`, capture the directory, and click both a row name and an avatar separately. Require `/users/{id}`, public name, **Дата регистрации**, and **Последний вход**.
2. Compare identity and dates with SQL. Nonzero **Комментарии**, **В галерее**, and **Магнеты** counts appear conditionally. Do not require absent zero-count rows.
3. If a real inactive user exists, bookmark its numeric profile and require 404 and exclusion from the directory. Do not fabricate a user record to force this branch.
4. Open `/@trip` and require redirection to `/@trip/travel`. Require **Поездки**, the traveler breadcrumb, and only that user's nonhidden chronology.
5. Click **По городам**. Require **Посещенные города** and real city names. Follow a linked city using its actual slug.
6. If the city has one published trip, require its redirect to the canonical story. Otherwise require the city title, country breadcrumb, year groups, and city map control.
7. Return and click **По странам**. Require **Посещенные страны**. Follow a linked country and require its title and that traveler's year-grouped trips.
8. Click the country view's city links and the story's country/city breadcrumbs separately. Check that generated hrefs keep the same traveler login.
9. Click **По годам** and a published story link. Require the story title, Markdown body, city timeline, adjacent-trip links when present, and comment area.
10. Enter the corresponding `/trips/{id}` bookmark. Capture the redirect to the same canonical story. Repeat with a real root-owned published trip and require `/life/{slug}` instead.
11. If an actual link supplies `anchor`, preserve it and require the redirect to retain that fragment. Do not invent an anchor and claim a working in-page target.
12. Use real date bounds as `?from=YYYY-MM-DD&to=YYYY-MM-DD` on the traveler year index. Compare visible trips and ascending date order with SQL. No date-filter form is rendered in this template.
13. With real inactive and hidden trips, require inactive chronology text but no published detail link, and require hidden trips to be absent. Their `/trips/{id}` entries must reject access.
14. Sign in as the traveler when credentials exist. Require **Новая поездка** on their index, the pencil on their story, and **Редактировать профиль** on their numeric profile. Require these owner controls absent anonymously and for another user.
15. Reopen all public views after any UI publication change. Save before/action/after extracts, screenshots, and the exact owner/status SQL under this run's evidence directory.

## Gotchas

- Source anchors are `UserController`, `UserHomeController`, `UserTravel*Controller`, `TripController`, `TripVisibleScope`, `resources/views/users/`, `resources/views/user-travel/`, and `components/user-trips-subnav.blade.php`.
- Numeric profiles require an active user. Login-based traveler binding is separate and does not apply that same active-user check in these controllers.
- The directory does not contain a traveler-home button. Do not invent a global **Пользователи** menu entry or a profile-to-travel link.
- Hidden trips are excluded by `TripVisibleScope`; inactive trips can remain listed without story links. Slug detail requires a published trip belonging to that traveler.
- Root canonical stories live under `/life`, even when reached through `/@root/travel`. Ordinary-owner canonical stories use `/@{login}/travel/{slug}`.
- Travelers without a login cannot use login-based discovery. Numeric `/users/{id}` profiles still work. Login edits change traveler URLs, not numeric profile URLs.
- Map controls can load external map resources. Inspect those boundaries before opening maps. Lazy images need actual load-state evidence, not an empty local-upload diagnosis.
- View events use deferred metrics processing. An unchanged immediate SQL view count is not proof that a visit failed. This recipe does not start a scheduler.
