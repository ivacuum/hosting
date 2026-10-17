# Personal trips

Verify that a signed-in traveler can create and edit their own trip and see its public publication state without changing another user's data.

## Sub-features

- `my-trips-list` covers GET `/my/trips`, its owner filter, empty state, and pagination of 40 rows.
- `my-trips-create` covers GET `/my/trips/create` and POST `/my/trips`.
- `my-trips-edit` covers GET `/my/trips/{trip}/edit` and PUT `/my/trips/{trip}` with both save actions.
- `my-trips-delete` maps DELETE `/my/trips/{trip}` and its ownership policy, but the personal templates expose no delete control.
- `my-trips-public` connects publication, **Просмотреть**, documentation, and the separate [traveler pages](travelers.md).

## How to get to it (user POV)

- From **Аккаунт**, click sidebar **Поездки** or choose it in the mobile account select to reach `/my/trips`.
- Click **Новая поездка** or the empty-state **добавить первую** link to `/my/trips/create`.
- `/docs/trips` links **специальный раздел** to `/my/trips`, **страница добавления поездки** to `/my/trips/create`, and **в профиле** to `/my/profile`.
- Your public `/@{login}/travel` page also has **Новая поездка** when signed in as that traveler.
- In the personal list, use a pencil link to `/my/trips/{id}/edit` or double-click its row. A published slug opens the canonical public story.
- **Просмотреть** opens `/@{login}/travel` only when the current user has a login. The question-mark link opens `/docs/trips`.
- A public story's owner pencil also enters its personal edit form. Direct bookmarks and `/en/my/trips` equivalents are separate entries.

## Driving it with Safari MCP

Preconditions:

- Use a ready isolated instance and Safari tab. Sign in as seeded `guest@example.com` with `top-secret`, not root.
- Require a nonempty user login and seeded city choices. Use a new slug such as `verification.2026` only after checking it is unused for this user.
- Record `SELECT id,user_id,city_id,slug,status,date_start,date_end,title_ru,title_en FROM trips WHERE user_id=(SELECT id FROM users WHERE email='guest@example.com')` through the run's SQL helper.
- Use fresh `get_page_content` UIDs and actual `page_interactions`. Save before/action/after and reopened state under the run's evidence directory.

1. Enter list, create, and a real edit bookmark anonymously. Require login redirects and no personal forms.
2. Sign in, follow **Поездки**, and inspect only the current user's rows. If empty, require **Хронология ваших поездок на данный момент пуста.** and **добавить первую**.
3. Click **Новая поездка**. Select **Город** `city_id` from actual options, fill **URL** `slug`, **Дата начала** `date_start`, and **Дата окончания** `date_end` with ISO dates.
4. Choose **Состояние** `status`, with `0` for **Неактивна**, `1` for **Опубликована**, or `2` for **Скрыта**. Fill **Текст** `markdown` with a distinct short note. Leave hidden `mail` blank.
5. Start with **Неактивна**, then click **Добавить поездку**. Require a return to `/my/trips` and a new owned row. SQL must show city-derived titles and the submitted dates, slug, status, and text.
6. Open the row's pencil link. Require edit-only **Название** `title_ru` and **Название EN** `title_en`, alongside the shared fields.
7. Change the titles and Markdown text, then click **Применить** with name `_save`. Require the edit page to remain open and saved values after reopening it.
8. Select **Опубликована** and click **Сохранить**. Require the list, then click the published slug. Require the new title and rendered Markdown in the public story.
9. Query `SELECT id,user_id,slug,status,title_ru,title_en,markdown,html FROM trips WHERE user_id=(SELECT id FROM users WHERE email='guest@example.com') AND slug='verification.2026'`. Compare the owner and rendered text without treating the flash or redirect as persistence proof.
10. Reopen edit and submit an end date before the start date. Require field feedback and unchanged dates in SQL. Check duplicate owner slug validation only with another real trip or a UI-created second trip.
11. Save **Скрыта** and check that the personal row remains, its slug is not a public link, and public traveler listings omit it. `/trips/{id}` must reject this unpublished record.
12. As guest, enter a real root-owned trip's edit URL. Require authorization denial and unchanged SQL for that trip. Never use root as proof of ordinary ownership enforcement.
13. Inspect the edit page and record delete as blocked because there is no delete form or button. Do not simulate DELETE with JavaScript, raw HTTP, or a fabricated form.
14. Follow **Просмотреть**, the documentation link, the public owner pencil, and row double-click separately when claiming those entries. Restore UI-created data only through available UI, otherwise dispose of the isolated instance.

## Gotchas

- Source anchors are `routes/web.php`, `MyTripController`, `TripStoreForm`, `TripUpdateForm`, `resources/views/my/trips/`, `resources/views/docs/trips.blade.php`, and `TripPolicy`.
- Create/store routes are auth-only and do not invoke the policy's root-only `create` method. Update and delete allow the owner or root.
- Slugs are unique per owner and lowercased. They accept letters, digits, dots, underscores, and hyphens. New trips derive titles from the selected city.
- **Применить** stays on edit, **Сохранить** returns to the list, and an existing `goto` changes those destinations. Preserve real `goto` values rather than inventing a return path.
- Inactive trips remain visible as chronology text. Hidden trips are excluded. Only published trips have public detail pages.
- Trip changes can update attached photo statuses and slug prefixes. Use new trips without photos for this bounded journey, not seeded root stories.
- The seed supplies a separate `trip@example.com` traveler with one random-city trip. Guest starts without guaranteed trips. Do not assume city, trip IDs, or publication dates.
- DELETE exists and redirects to the list after deletion, but its successful browser journey remains unproved until a real user-facing delete entry exists.
