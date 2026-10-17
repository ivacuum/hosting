# Shared navigation and media controls

Readers use the site menus, locale links, pagination, keyboard shortcuts, dismissible notices, and embedded-video controls across feature pages.

## Sub-features

- `shared-navigation` follows desktop header, mobile bottom tabs, breadcrumbs, and pagination.
- `shared-language` switches the current page through links and keyboard shortcuts.
- `shared-reading` moves between paragraphs or screenshots with reading shortcuts.
- `shared-video` opens and closes an embedded video.
- `shared-notices` dismisses a notice without changing the page's content.

## How to get to it (user POV)

- The desktop header exposes `Заметки`, `Новости`, `Магнеты`, `Фотки`, and the account control. The mobile bottom bar exposes home, notes, photos, and sign-in/profile.
- Breadcrumbs and page links are part of their host feature. `/games` supplies catalog pagination; notes and photo details can supply previous/next links.
- Footer `In English` and `По-русски` switch locale. Keyboard shortcuts are `Alt+E` and `Alt+R`.
- A note or game review with `.js-shortcuts-item` entries accepts `h`, `j`, `k`, and `l`. Search pages with `.js-search-input` accept `/` to focus search.
- Notes, concert stories, and PSY song pages can expose `Открыть видео …` and `Закрыть видео …` links.

## Driving it with Safari MCP

Preconditions:

- Doctor is ready. Read the host feature's data requirements first.
- Keyboard focus is outside an input or editable field. Use actual `keyPress` actions, not dispatched application events.
- Video playback requires access to YouTube. Opening a player can fetch an external iframe and start playback.

- **Navigation.** Capture the current page, click each visible header or bottom-bar href, and require its expected route and heading. Check desktop and mobile separately. If a menu toggle is present, click its `.js-collapse` control and require its `data-target` menu to appear, then disappear on another click.
- **Breadcrumbs.** Follow a parent breadcrumb from a detail page, then reopen the same visible detail link. Require matching parent and detail identities. Record the path rather than substituting a direct navigation.
- **Pagination.** On `/games`, follow an actual numbered page link and the `#next_page` or `#prev_page` controls where present. Require changed page/query and corresponding visible records. Independently use `Ctrl+Right` or `Alt+Right`, then the matching left shortcut, and require the same transitions. These keys can conflict with browser or OS shortcuts; record the actual resulting URL.
- **Locale.** Click the footer locale link and require the same resource identity under the other locale. Repeat with `Alt+E` and `Alt+R`. Require the document language as well as translated UI text. Missing authored translations remain a separate failed prerequisite.
- **Reading.** On `/games/slay-the-spire`, press `h`, `j`, `k`, and `l` outside inputs. Require the `.js-shortcuts-item.focus` entry and scroll position to follow first, next, previous, and last screenshot. On a story, repeat with its paragraph entries. Capture focused entry and position before and after, not just key-delivery success.
- **Search focus.** On a page with the actual search field, press `/` and check that the `.js-search-input` element becomes `document.activeElement`. Continue through that feature's normal search recipe.
- **Video.** Open a page with a visible `Открыть видео …` link, click it, and require `Закрыть видео …` plus a YouTube iframe with the advertised video ID. Close it and require the iframe to disappear. Capture both states and the external resource URL. Opening a player does not prove successful playback without observing playback.
- **Notice.** If the language suggestion or a flash notice is present, click its visible `×` control. Require that notice to disappear while article/form content and the route stay unchanged. Do not manufacture a notice by setting DOM state.

## Gotchas

- These shared controls are verified through their host feature journeys, not as independent routes.
- Safari tools can extract hidden duplicate links. Use visible controls and the intended responsive layout, not whichever matching href is easiest to click.
- `Ctrl+Enter` typo reporting is covered by [feedback and comments](feedback-comments.md). Do not send a report merely to test a key.
- Video open/close and trainer actions queue beacon events. They can flush on tab visibility changes or page exit; see [integrations](integrations.md).
- A successful image download is not a layout check. Use the pending/loaded screenshot checks in [games](games.md).
