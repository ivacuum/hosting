# Japanese learning

Verify Japanese resource discovery, kana practice, word practice, WaniKani browsing, search, and account-owned learning marks.

## Sub-features

- `japanese-discover` opens `/japanese` and its internal learning links.
- `japanese-kana` selects columns and practices hiragana, katakana, or both at `/japanese/hiragana-katakana`.
- `japanese-words` answers, reveals, skips, changes settings, and follows history at `/japanese/words-trainer`.
- `wanikani-browse` covers `/japanese/wanikani`, `/japanese/wanikani/level`, and `/japanese/wanikani/level/{level}`.
- `wanikani-subjects` covers `/japanese/wanikani/kanji`, `/radicals`, and `/vocabulary`, plus `/kanji/{character}`, `/radicals/{meaning}`, and `/vocabulary/{characters}` under the same prefix.
- `wanikani-search-burn` searches English meanings and persists per-user burned subjects.

## How to get to it (user POV)

- On `/`, click `Японский язык` to `/japanese`. Click `Тренажер хираганы и катаканы`, `Тренажер по набору слов хираганой и катаканой`, or `WaniKani V`.
- Alternatively open `/trainers` through `Тренажеры` and follow either Japanese trainer card. These are separate discovery paths.
- On the kana page, `следующем тренажере` opens the words trainer. `потренировать японские числа` and `китайские числа` open `/trainers/numbers?lang=ja` and `?lang=zh`.
- On WaniKani V, click `Ключи`, `Кандзи`, or `Словарные слова`, or a numbered link beneath `По уровням`. Open `/japanese/wanikani/level` separately as a bookmark.
- Click a subject's colored character link to open its detail. Its level badge returns to the corresponding level. Word-trainer purple links and history links also enter vocabulary details.
- The Japanese introduction links directly to `空` and the radicals `construction`, `legs`, and `helmet`. Exercise these separately from seeded subject links.
- Copy real detail and list URLs for bookmark checks. Repeat `/en/japanese/...` and the footer locale switch as separate entries.

## Driving it with Safari MCP

Preconditions:

- Require doctor readiness, built Vue assets, and the WaniKani seeders. Standard seeds contain 7 radicals, 6 kanji, and 5 vocabulary words, all within levels 1 through 9.
- Use `guest@example.com` / `top-secret` only for learning marks, and verify that identity at `/my/profile` first.
- Audio requires the remote URLs rendered in `#male_audio` and `#female_audio`. Require actual network/playback evidence, not the presence of volume icons.
- Missing late-level words, example sentences, or introductory linked subjects fail those journeys. Do not invent data or treat empty lists as successful populated browsing.

1. Follow both discovery paths above and save their href transitions. Require the correct trainer, not just a Japanese heading.
2. At kana practice, click `Снять выделение` and require `Практиковаться` disabled. Select the first column with `#column_0` or its actual kana cells.
3. Click `Практиковаться`. Type the shown kana's Latin reading in `input[placeholder=kana]` without Enter. Require `Отвечено` to increase and a different question.
4. Press Space, then separately Enter, to reveal an answer without increasing the answer count. Click the question itself to test the alternate reveal path.
5. Click `Назад к выбору`. Exercise `Выбрать все`, individual column toggles, `катакана`, and `обе азбуки сразу`. Require questions from the selected columns and syllabaries.
6. At the words trainer, type a valid reading for the actual displayed word into `Ваш ответ` and press Enter. Require `Отвечено`, a new word, and the old word in history.
7. Use incorrect text or the `Показать ответ` question button. Require the green romaji answer, `Подсказано`, and `Далее`. Use `Пропустить` before revealing and require `Пропущено` instead.
8. Open `Настройки`, switch `Хирагана` to `Катакана`, and require the reading to change while the word remains. Test `Увеличить` and `Уменьшить` level ranges only with populated data. The next word uses that range.
9. Follow a purple word and a history link to details. For the current word, exercise accepted romaji, hiragana, katakana, and original character answers in separate actual rounds, never by selecting an internal vocabulary ID.
10. On WaniKani V, follow every category and a populated level. In each subject list, click `Показать подписи` and `Подписывать при наведении`, and test `Перемешать` where rendered. Require the same subject set after shuffling.
11. In vocabulary lists, click a row's `？` to reveal only that row. Do not confuse this link with the trainer's reveal button.
12. Follow list `#next_page` and `#prev_page` links. Kanji and radical ranges advance by ten levels; vocabulary ranges advance by five. Verify both URL `from` and rendered headings. Test Ctrl+Right and Ctrl+Left outside inputs as alternate pager paths.
13. From a populated level detail, follow previous and next level links. Check level 1 has no previous link and level 60 has no next link, independently of whether those levels contain subjects.
14. Open radical `ground`, kanji `一`, and vocabulary `一月` from rendered links. Require meanings, relevant readings, level badges, and linked related subjects. Use `時` or `待` for `Похожие кандзи`.
15. At vocabulary detail, click the real volume buttons identified through HTML by their audio target. Require playback progress and successful media requests. Check `Примеры предложений` only with a populated sentences fixture.
16. In `.js-search-input`, enter `moon` and submit with Enter. Require matching English-meaning results and follow one. Submit `mo` for `Поисковый запрос должен быть не менее 3 символов`, then a nonsense query for the no-results message. Use `Очистить` after a successful result.
17. Sign in and open each subject type. Click `Сжечь ключ`, `Сжечь кандзи`, or `Сжечь слово`; require `Восстановить`, then reload and require the mark retained.
18. Verify the matching user, subject type, and subject ID in `burnables` with read-only SQL. Check list `Показать сожженные` and `Скрыть сожженные`, plus the vocabulary row flame link. Click `Восстановить` and require the row removed and the subject visible again.
19. Repeat anonymously and require burn controls absent. Practice counters/settings are page state, not saved learning progress. Reload and record their reset separately from persistent burn marks.
20. Use [Feedback and comments](feedback-comments.md) for the kana page's `Обратная связь` form, whose hidden title is `Hiragana Katakana Trainer`.

## Gotchas

- Standard seeds cannot satisfy the introductory `空`, `construction`, `legs`, or `helmet` links. Record the broken-link journey, not a substituted early-level subject.
- Standard vocabulary has no sentences or words above level 7. Increasing the trainer to levels 11 through 20 has no seeded candidate and can error on the next question. Report this prerequisite failure without internal setters.
- Word answers require Enter. Kana answers advance automatically. A second incorrect check after revealing a word advances without increasing `Отвечено`.
- WaniKani search is a minimum-three-character SQL search over English meanings, not a kanji-input search or a Scout search.
- Anonymous users can browse and practice. Only burns persist by account. External WaniKani, JapanDict, Jisho, Bunpro, and LingoDeer links do not prove local behavior.
- Source pointers are `routes/web.php`, `resources/views/japanese/**`, `resources/views/livewire/{vocabulary-trainer,wanikani-search,radical-list,kanji-list,vocabulary-list,burn-*}.blade.php`, `app/Domain/Wanikani/{Livewire,Seeder,Action,Models}/`, `app/Http/Controllers/JapaneseWanikani*`, `WanikaniLevelController`, the matching requests, and `lang/ru/japanese.php`.
