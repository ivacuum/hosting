# Korean learning

Verify Korean discovery, Hangul recognition, keyboard reference controls, and the complete PSY lyrics index.

## Sub-features

- `korean-discover` reads `/korean` and follows its trainer and lyrics links.
- `korean-hangul` practices consonants and vowels at `/korean/hangul`.
- `korean-keyboard` changes the font and shifted keyboard reference.
- `korean-psy` opens `/korean/psy` and every `/korean/psy/{song}` lyrics page.
- `korean-media` opens and closes the actual song video controls without claiming external playback from local HTML alone.

## How to get to it (user POV)

- On the Russian home page, click `Корейский язык` to `/korean`.
- Click `Тренажер хангыля` or `кириллизация песен PSY` from that introduction.
- Alternatively open `/trainers` from `Тренажеры` and click its `Тренажер хангыля` card.
- The introduction's `концерта 2018 года` links to `/life/psy.2018`. The lyrics index also links to that concert through `с 2018 года`.
- At `/korean/psy`, each title links to its actual slug. `Gangnam Style` opens `/korean/psy/gangnam-style`.
- Open a copied song URL and `/korean/hangul` as independent bookmarks. The trainer help links to `/trainers/numbers?lang=ko` through `тренажере корейских чисел`.
- The trainer supports `/en/korean/hangul` and a footer language switch. The Korean introduction and PSY templates suppress the language selector; do not invent one.

## Driving it with Safari MCP

Preconditions:

- Require a ready isolated instance and working Livewire requests. Anonymous users can use all routes in this file.
- Hangul needs PHP intl transliteration, not database vocabulary fixtures. Italic rendering needs the external Google Fonts `Nanum Pen Script` resource.
- Inspect external video hrefs before expanding them. YouTube embeds autoplay and need separate network/playback permission and availability.
- Record missing media/font prerequisites as failed or blocked sub-features, not as a passed media journey.

1. Follow the home and trainer-index entries separately. Require the displayed jamo, `Ваш ответ`, `показать ответ`, and the help heading `Тренажер хангыля`.
2. Read the displayed jamo and type its Latin answer through the real answer input. Press Enter and require `Отвечено` to increase and a different jamo.
3. In Russian, answer another round with a valid Cyrillic reading from the keyboard reference. Require the same successful transition. English accepts Latin only.
4. Type an incorrect answer and press Enter. Require green accepted answers and `Подсказано`, with no increment to `Отвечено`.
5. On a fresh round, click `показать ответ`. On another round, press Space in the answer field. Require the same reveal state through each path.
6. After reveal, enter a correct answer and require `Отвечено` to increase. Separately check that another incorrect check advances without counting an answer.
7. Select `согласные`, `гласные`, and `все вместе` under `Что будем тренировать?`. Require the next jamo to belong to the selected group and the input/reveal state to reset.
8. Under `Стиль шрифта`, select `курсив`, then `обычный`. Require the rendered jamo font to change and the Google font to load for the italic case.
9. Scroll to the keyboard reference. Click `⇧ Shift нажат` and require doubled consonants such as `ㅃ` instead of `ㅂ`, plus `ㅒ` and `ㅖ`. Click `⇧ Shift отпущен` and require the original layout.
10. Follow `тренажере корейских чисел` and require the Korean language selection and `lang=ko`. Use [Number trainer](number-trainer.md) for that journey.
11. Reload the trainer. Require page-local counters and settings to return to defaults. Do not claim persisted proficiency or a new user record from practice.
12. Open `/korean/psy` and record every title/href pair. Follow every link and require its song heading plus readable Hangul and Cyrillic lyric blocks, then return to the index.
13. Include all current slugs in that sweep: `all-night-long`, `as-time-goes-by`, `bird`, `celeb`, `champion`, `daddy`, `dont-worry-my-dear`, `dream`, `entertainer`, `everyday`, `father`, `gangnam-style`, `gentleman`, `i-am-a-guy-like-this`, `i-luv-it`, `in-my-eyes`, `its-art`, `last-scene`, `napal-baji`, `new-face`, `paradise`, `place-to-lean-on`, `right-now`, `shake-it`, `someday`, `that-that`, `the-end`, `we-are-the-one`, `what-would-have-been`, `white-night`, and `you-move-me`.
14. On Gangnam Style, click `Открыть видео All Night Stand 2019`. Require its iframe and YouTube link. Click `Закрыть видео All Night Stand 2019` and require the iframe removed.
15. Exercise the separate `All Night Stand 2015` control. Other song material controls use their own rendered titles; record each used label and URL.
16. Open an unknown song bookmark and require 404 rather than fallback lyrics. Capture browser text, screenshots, and console/network errors for failed pages.
17. Use [Feedback and comments](feedback-comments.md) for the Hangul feedback form, whose hidden title is `Hangul Trainer`.

## Gotchas

- The Shift controls are radio buttons for the reference keyboard. Holding the physical Shift key is not the documented control.
- Some jamo have multiple Cyrillic answers. Use the displayed accepted answers or reference labels rather than guessing a single transliteration.
- English Hangul rejects Cyrillic by design. The Russian-only introduction and lyrics content do not become English translations merely because an `/en` URL renders.
- Song pages come from templates, not song database rows. The index is sorted by template basename, with hyphens replaced by spaces and title casing applied.
- Lyrics have no completion action or saved progress. A successful reveal does not verify an external video's sound.
- Source pointers are `routes/web.php`, `resources/views/korean/**`, `resources/views/livewire/{hangul-trainer,youtube}.blade.php`, `resources/views/components/{korean-cyrillization,lyrics}.blade.php`, `app/Domain/Korean/Livewire/HangulTrainer.php`, its jamo actions, and `app/Http/Controllers/KoreanPsy{,Song}Controller.php`.
