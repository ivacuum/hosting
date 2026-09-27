---
name: game-screenshot-explainer
description: "Explains game screenshots. Activate when working with `resources/views/life/games/*.blade.php` files which don't have Russian text for every screenshot."
---

# Game Screenshot Explainer

Help turn screenshots into a record of memorable moments from the author's play sessions. These images were usually captured to remember something specific, rather than to showcase the game or document a complete playthrough.

Use the Blade filename to identify the likely game, and confirm it against the screenshots and existing text. Ground each caption in the image and author-provided context. Make the moment understandable to someone unfamiliar with the game, using only the game knowledge needed to explain it.

## Usage Guide

Support both raw lists of image filenames and partially completed drafts.

Before editing, read the entire target file to understand its introduction, existing captions, and screenshot sequence.

- Preserve existing prose, screenshot filenames, include arguments, and screenshot order.
- Add descriptions only for screenshots that do not already have an associated Russian caption. A caption may span multiple paragraphs or describe a group of screenshots; consider the surrounding text rather than only the immediately preceding line.
- Do not expand or rewrite an existing caption merely because it is short.
- If the file already has an introduction, preserve it. Otherwise, add an opening Russian paragraph explaining the game's premise, goal, and core rules.
- When resuming interrupted work, skip screenshots that already have captions and continue with the first uncaptained screenshot in document order.
- If the introduction and all captions are already present, leave the file unchanged.

## Writing style

- Read the target file before writing and match the author's existing tone. Use `resources/views/life/games/hades.blade.php` as an additional reference for concise, direct prose.
- Use natural, conversational Russian. Avoid promotional language, grand claims, and unnecessary evaluations such as «уникальная механика» or «один из самых интересных навыков».
- Do not invent first-person experiences, opinions, or emotions on behalf of the author.
- Focus on the specific moment rather than giving a generic explanation of the screen. Look for distinctive visible details: an unusual result, a close call, a funny exchange, an unexpected combination, an achievement, or an interaction between players. These are possibilities, not a checklist; do not force a screenshot into one of them.
- Explain what makes the visible situation noteworthy when the evidence supports it, without claiming to know why the author took the screenshot. If its personal significance is unclear, describe the concrete moment plainly.
- Usually write one to three concise sentences per caption. Explain unfamiliar terms when first needed, and avoid repeating mechanics already introduced in the surrounding text.
- In multiplayer games, treat individual matches, encounters, and shared moments as meaningful in themselves. Do not impose a campaign arc or present the screenshot sequence as progress toward finishing the game.

### Analyze the Screenshot

For each screenshot, open the image and inspect it visually before writing its description. Use `~/Downloads/buffer/` as the default image directory, matching the filename exactly. If the user provides another location, use that instead.

For example, `Hades Screenshot 2021.03.23 - 06.00.32.64.webp` is available at `~/Downloads/buffer/Hades Screenshot 2021.03.23 - 06.00.32.64.webp`.

- If an image is missing or cannot be opened, leave its entry unchanged and continue with the next screenshot. Do not insert a placeholder caption.
- If important details or text are unclear, zoom in or inspect a crop when possible.
- If the image still cannot be interpreted reliably, leave its caption pending.
- At the end, report the exact filenames of unresolved screenshots and explain what prevented describing each one. Ask for replacement images or their location when needed.

### Accuracy and uncertainty

- Ground descriptions in the actual image. A filename, neighboring caption, or general game knowledge cannot substitute for visual evidence of what this screenshot shows.
- Distinguish visible facts from game context. Describe what is on screen, then explain relevant mechanics or story context only when you can establish them confidently.
- Use readable on-screen text to support names, dialogue, statistics, and outcomes. Do not guess unreadable dialogue, numbers, names, or interface labels, or reconstruct them from memory.
- Verify uncertain character names, locations, quests, and mechanics using reliable references when those details are needed. Account for the game's version, localization, or mods when relevant.
- If a detail remains uncertain, use a broader accurate description or omit it. Do not turn a plausible interpretation into a factual statement.
- Do not invent the player's intentions, feelings, decisions, or off-screen events. Preserve personal context already supplied by the author.

### Output format

Separate paragraphs and caption–screenshot sections with one blank line in the Blade source. Keep `@endru` immediately followed by its associated `@include`; insert the blank line after the include, before the next `@ru` block. Also leave a blank line between consecutive `<p>` elements within a caption.

```blade
@ru
  <p>Объяснение скриншота на русском языке.</p>
@endru
@include('tpl.game-screenshot', ['pic' => 'Hades Screenshot 2021.03.23 - 06.00.32.64.webp'])

@ru
  <p>Объяснение следующего скриншота.</p>
@endru
@include('tpl.game-screenshot', ['pic' => 'Hades Screenshot 2021.03.24 - 18.24.20.94.webp'])
```

- **No Sub-Agents:** Do not use sub-agents to describe screenshots. Sub-agents process images in isolation and lose the context of the whole story.
- **One screenshot at a time:** Inspect an uncaptained screenshot, write its caption to the target file immediately, then move to the next. Save progress incrementally so interrupted work can resume without losing completed descriptions.

## Final review

After processing the screenshots, reread the completed file and review the diff.

- Confirm that every screenshot has an associated Russian caption, individually or as part of a clearly described group, or is listed as unresolved in the final response.
- Confirm that existing prose, screenshot filenames, include arguments, and screenshot order are preserved.
- Check that newly added `@ru` / `@endru` blocks and HTML tags are balanced, and that captions appear before the screenshots they describe.
- Check that paragraphs and caption–screenshot sections are separated by one blank line, matching the output example.
- Review new captions for unsupported claims, repeated explanations, and generic descriptions that overlook the distinctive visible moment.
- Confirm that no introduction or caption was duplicated when resuming work.
- Briefly report what was added and list any unresolved screenshots with the reason each remains pending. Do not claim completion if captions are still missing.
