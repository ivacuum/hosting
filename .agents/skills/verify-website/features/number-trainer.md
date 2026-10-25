# Number trainer

Verify trainer discovery, numeric and spelling answers, intervals, speech controls, and the number synopsis.

## Sub-features

- `trainers-discover` opens `/trainers` and each language-trainer card.
- `numbers-practice` answers, reveals, and skips at `/trainers/numbers`.
- `numbers-settings` changes language, interval, answer mode, and reading/listening mode.
- `numbers-speech` selects device voices, speaks a prompt, and lists available voices.
- `numbers-synopsis` changes the language and number at `/trainers/numbers/synopsis`.

## How to get to it (user POV)

- On `/`, click `Тренажеры` to `/trainers`. Click `Тренажер чисел` to `/trainers/numbers`.
- The other three cards link to `/japanese/hiragana-katakana`, `/japanese/words-trainer`, and `/korean/hangul`. Verify those transitions separately with their feature maps.
- From kana help, follow `потренировать японские числа` or `китайские числа` to `?lang=ja` or `?lang=zh`.
- From Hangul help, follow `тренажере корейских чисел` to `?lang=ko`.
- Open `/trainers/numbers/synopsis` as a bookmark. No synopsis link is rendered in the inspected trainer template, so do not claim a menu path to it.
- Use `Помощь` to reach `#help`. Its `тренажеров` link returns to `/trainers`.
- Repeat the footer language switch and direct `/en/trainers`, `/en/trainers/numbers`, and `/en/trainers/numbers/synopsis` entries separately.

## Driving it with Safari MCP

Preconditions:

- Require a ready instance, built assets, Livewire responses, and PHP intl. No authentication or language-table fixture is needed.
- Speech needs Safari `speechSynthesis` and a device voice matching the selected language. An empty `Голос` select blocks speech/listening proof, not text practice.
- Discover actual Safari interaction signatures for select controls and keys. Change real controls only; never assign `number`, `answer`, or settings through Livewire internals.

1. Follow the home and cross-trainer entries above. Require the selected language to match `lang` and a real prompt with `Ваш ответ`.
2. In English, read the spelled-out prompt, type its numeric answer into `.js-answer`, and press Enter. Require `Отвечено` to increase and the prompt to change.
3. Enter an incorrect number. Require the revealed answer, incorrect-answer styling, `Подсказано`, and `Далее`. Enter the now-visible correct answer and require the next round.
4. Click `показать ответ` on a fresh round and require reveal without an answered increment. Click `Далее` to advance without a skipped increment.
5. Click `Пропустить` before revealing. Require `Пропущено`, another prompt, and focus returned to the answer input.
6. Under `Язык`, change the actual select identified by `wire:model.live="lang"`. Require a new prompt, translated number text, and updated URL query. Reload that URL and require the selected language retained.
7. Choose each source-linked language `ja`, `zh`, and `ko` through its entry link. Confirm the UI locale and practiced language remain independent.
8. Under `Вид ответов`, choose `Написание чисел`. Require a numeric prompt and a text answer input. Type the correct spelling and press Enter, then separately verify a supported transliteration on a real new round.
9. Return to `Сами числа`. Require a spelled-out prompt and numeric answer input. Switching modes alone does not prove that an answer was accepted.
10. Under `Интервал возможных чисел`, select a larger predefined interval. Advance to a fresh question and require the value within its bounds.
11. Select `Задать свой`, then edit the `От` and `до` number inputs. Wait beyond the one-second debounce after each edit. For minimum 20 and maximum 25, require subsequent questions within that interval.
12. Enter a minimum close to the maximum and require the displayed interval to expand to at least five. Return to `Предопределенный` and require minimum zero and a supported maximum.
13. Click the `.js-speak` volume button and require actual speech evidence. Change `Голос` through `.js-voices` and require pronunciation using that selected voice.
14. Select `Хочу слушать` under `Вид заданий`. Require the visual prompt hidden until reveal, a spoken new question, and a successful answer. Return to `Хочу читать` and require a visible prompt.
15. Follow `Помощь`. Click `Какие голоса есть в моем устройстве?` and require `.js-voice-list` entries matching available device voices. The button removes itself afterward.
16. At the synopsis bookmark, require `Краткий обзор`, `Язык`, `Число`, and table columns `Число` and `Написание`.
17. Replace the synopsis input identified by `wire:model.live="input"` with `42`. Require its first table row to show 42 and its correct spelling, while the fixed reference rows remain.
18. Change the synopsis language and require both the first row and fixed rows to update, with `lang` reflected in the URL. Japanese also has a transliterated reading when distinct.
19. Enter non-integer text, a negative value, or a value above 10000000000. Require inline validation and retain the last valid first row. Restore valid input and require recovery.
20. Reload both pages. Only the `lang` query is bookmark state. Practice counters, custom intervals, and the synopsis custom number are not database records and return to defaults.
21. Use [Feedback and comments](feedback-comments.md) for the embedded form with hidden title `Number Trainer`. Save per-action evidence independently from text-practice evidence.

## Gotchas

- A predefined maximum does not produce a uniform distribution across its whole range. Check bounds, not a guessed sampling distribution.
- A changed interval affects newly selected questions. Advance before checking the range contract.
- Reading a hidden `.js-utterance` is not evidence of successful listening. No matching voice means listening remains unverified.
- Speech playback is a device boundary. A successful Livewire request or a populated select alone cannot prove audible output.
- Several help sections have only an `@ru` branch, so the English trainer omits them instead of showing Russian. Record actual output rather than assuming full translation.
- Source pointers are `routes/web.php`, `resources/views/trainers/*`, `resources/views/livewire/{number-trainer,number-synopsis}.blade.php`, `app/Livewire/{NumberTrainer,NumberSynopsis}.php`, `app/Action/GetNumberLocalesAction.php`, and `app/Domain/Japanese/Action/SpellOutJapaneseNumberAction.php`.
