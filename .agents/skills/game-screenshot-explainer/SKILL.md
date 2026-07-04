---
name: game-screenshot-explainer
description: "Explains game screenshots. Activate when working with `resources/views/life/games/*.blade.php` files which don't have Russian text for every screenshot."
---

# Game Screenshot Explainer

Your goal is to explain every screenshot you find in the document like you would explain to a person that sees the game for the first time. The game name is in the name of the blade file. You are the expert gamer and know well that game.

As a first paragraph, write a detailed explanation of what this game is about and what are its rules.

## Usage Guide

Your goal is to transform a raw list of image filenames into a structured first draft.

### Analyze the Screenshot

For each screenshot (`xxx.webp`), read it visually. Real screenshots are available in `~/Downloads/buffer/` folder (for example, `Hades Screenshot 2021.03.23 - 06.00.32.64.webp` is available as `~/Downloads/buffer/Hades Screenshot 2021.03.23 - 06.00.32.64.webp`).

### Output format

```blade
@ru
  <p>Объяснение скриншота на русском языке.</p>
@endru
@include('tpl.game-screenshot', ['pic' => 'Hades Screenshot 2021.03.23 - 06.00.32.64.webp'])
```

- **No Sub-Agents:** Do not use sub-agents to describe screenshots. Sub-agents process images in isolation and lose the context of the whole story.
- **One unit at a time:** Write each photo's description to the file immediately after processing it. Do NOT batch multiple writes—the process will likely hang with nothing written.
