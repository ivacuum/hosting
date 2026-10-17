# Life extras

Verify the author's reading, listening, language, household, film, and travel-resource pages without confusing outbound recommendations with local services.

## Sub-features

- `life-books` covers `GET /life/books` and its year-grouped book links.
- `life-chillout` covers `GET /life/chillout` and its Mixcloud recommendation.
- `life-english` covers `GET /life/english`, including `#irregular-verbs` and `#articles` bookmarks.
- `life-favorite-posts` covers `GET /life/favorite-posts` and its categorized external reading list.
- `life-german` covers `GET /life/german` and its alphabet and pronunciation notes.
- `life-laundry` covers `GET /life/laundry` and all six section anchors.
- `life-movies` covers `GET /life/movies`, year grouping, horizontal poster lists, and Kinopoisk links.
- `life-podcasts` covers `GET /life/podcasts` and its program and episode links.
- `life-travel-tools` covers `GET /life/using-in-travels` and its local news recommendation and external resources.
- All nine routes also exist under `/en/life/`. Route availability does not imply complete English content or a visible locale switch.

## How to get to it (user POV)

- Open `/life` through `Заметки`. Under `Избранное`, click `Книги`, `Chillout`, `Любимые посты`, `Подкасты`, `Условные обозначения стирки`, `Фильмы и сериалы`, or `Чем пользуюсь в путешествиях`.
- Under `Языки`, click `Английский` or `Немецкий` to their corresponding `/life/` routes.
- Bookmark any route above, including `/life/english#articles` or `/life/laundry#iron`.
- The English life index exposes `Английский` through its translated label, but hides the Russian-only favorites and German entries.
- Where offered, footer `In English` and `По-русски` preserve the current page path.

## Driving it with Safari MCP

Preconditions:

- Require the ready isolated instance. No account is required. `FavoriteMovieSeeder` must supply the movie catalog.
- Movie covers load from `st.kp.yandex.net`. Other recommendations leave the site when followed. Inspect hrefs before external navigation.
- `/news/271`, linked as `Дримсим`, is historical production content absent from the standard news seed. Its intended article journey needs that prerequisite.

1. On `/life`, extract the favorites and language links with fresh UIDs. Click each of the nine entries, return to `/life`, and record the matching route and visible content.
2. On books, require `Понравившиеся книги`, years `2021`, `2014`, and `2013`, and `The Design of Everyday Things`. Inspect its Amazon href ending `/dp/0465050654` and the Ozon book links without purchasing anything.
3. On chillout, require `Спокойная музыка для фона.` and `Chillout Breeze by M.SOUND` with href `https://www.mixcloud.com/chilloutcafe/`. This page has a link, not a local audio player.
4. On English, require `Неправильные глаголы`, a populated verb table, and `Артикли`. Open each fragment bookmark independently and require its target in view. Click `In English` and require `Irregular Verbs` and `Articles` on `/en/life/english`.
5. On favorite posts, require `Интересное`, `Пополняемое`, `Подборки по странам`, and `Отдельные посты про путешествия`. Inspect `https://www.geoguessr.com/` and the Wikipedia visa-requirements href. Do not treat external-site login as local behavior.
6. On German, require `Алфавит и произношение`, `Дифтонги`, and alphabet entries including `Ä`, `Ö`, `Ü`, and `ß`. Require no Russian-page language selector, as configured by the view.
7. On laundry, click `Стирка` to `#wash`, `Сушка` to `#dry`, `Отжим и сушка` to `#dryer`, `Глажка` to `#iron`, `Химчистка` to `#dry-cleaning`, and `Отбеливание` to `#bleach`. Require the fragment and corresponding explanation after each click.
8. On movies, require `Фильмы и сериалы, достойные многократного просмотра` and the release-year explanation. Scroll down to `1991 год` and require `Терминатор 2: Судный день`, `Terminator 2: Judgement Day`, and `https://www.kinopoisk.ru/film/444/`.
9. Scroll the movie years vertically and a multi-card year horizontally through Safari interactions. Require cards beyond the initially visible portion. Scroll lazy posters into view and inspect actual load state. Record broken or unsettled remote images separately from catalog success.
10. On podcasts, require `Брендятина`, the `iTunes` and `podfm.ru` links, and episodes `Twitter`, `Туполев`, and `FedEx`. Inspect their `/1270/`, `/782/`, and `/102/` podfm hrefs.
11. On travel tools, require `Мобильные приложения`, `Навигация в городах`, `Выгодные предложения`, `Авиабилеты`, and `Жилье`. Inspect app-store links, `https://wikitravel.org`, and `https://www.aviasales.ru/?marker=79853`.
12. Click travel tools' `Дримсим` to `/news/271`. Record failure if the intended article is missing, even if news redirects to a working index. Return and require no language switch on the travel-tools page.
13. Independently bookmark all nine English route variants. Record the actual heading and body language for each. Return through visible locale links where available. Save before/action/after text and screenshots rather than claiming every body is translated.

## Gotchas

- These pages do not create or edit user content. Browsing recommendations is not proof of an external purchase, podcast playback, or language exercise.
- Movies remain bilingual in the card text and use Russian year captions even under `/en`. Most other extras contain Russian-only prose.
- The laundry symbols are inline SVGs, not missing image downloads. Anchor clicks change position and URL, not the database.
- Missing seeded movies fail the catalog journey. Do not replace real poster assets with synthetic pictures.
- Sources are the nine `resources/views/life/` templates, `life/index.blade.php`, `tpl/kp_movies.blade.php`, `MovieController`, `FavoriteMovie`, `FavoriteMovieSeeder`, and `routes/web.php`.
