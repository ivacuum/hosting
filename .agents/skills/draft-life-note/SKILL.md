---
name: draft-life-note
description: >-
  Writes first draft note for a travel trip. Activates when dealing with `resources/views/life/trips/*.blade.php` files which only have lonely `IMG_xxxx.yyy` lines.
---

# Life note writer

## When to Apply

Activate this skill when:

- Working with `resources/view/trips/*.blade.php` file
- That file doesn't have Russian or English text for every `IMG_xxxx` image

## Context and Style

The author acts as an experienced **Urban Observer**. The tone is **neutral, concise, and informative**, occasionally spiced with **dry humor or irony**. The author is not a typical "tourist" admiring views, but rather an inspector of how the city functions.

**Key characteristics:**

- **Genre:** Urban exploration / Travel log / Infrastructure review.
- **Vibe:** "How does this work?", "How much does it cost?", "Why is this here?", rather than "Look how beautiful this is."
- **Evolution:** Consistent style since 2007.

## Usage Guide

Your goal is to transform a raw list of image filenames into a structured first draft.

### 1. Context Gathering (Crucial)

Before analyzing any images, you **must** establish the context of the destination.

1. **Identify the City:** Parse the current filename (e.g., `berlin_2016.blade.php` -> `berlin`).
2. **Find Previous Visits:** Search for other files in `resources/views/life/trips/` that start with the same city name (e.g., `berlin_2017_05.blade.php`, `berlin_2019.blade.php`).
3. **Read & Digest:** Read those files to understand:
   3.1. What has already been described? (Do not repeat descriptions of the TV Tower if it was covered in 2016).
   3.2. What was the vibe back then?
   3.3. **Goal:** Your new notes should focus on *what changed* or *new details* not previously noticed.
4. **Global Context:** Keep in mind your knowledge of other cities. If a trash can looks like one in Tokyo, or a metro gate reminds you of Paris, **make that connection**.

### 2. Analyze the Image

For each image (`IMG_xxxx.yyy`), read it visually and check its metadata (using `exiftool`). Real images are available in `~/Downloads/buffer/` folder (for example, `IMG_1234.jpeg` is available as `~/Downloads/buffer/IMG_1234.jpeg`).

**What to look for (Topics of Interest):**

- **Public Transport:** Interiors (seats, screens), ticket machines (interface, price), stations, navigation signage, bus stops.
- **Road Infrastructure:** Signs, markings, traffic lights, surface quality (tiles vs asphalt), curbs, parking meters.
- **Urban Furniture:** Benches, manholes, trash cans/recycling, fences, mailboxes, intercoms.
- **Retail:** Supermarket shelves, prices, receipts, vending machines, distinct packaging.
- **Accommodation:** Interior details (switches, plugs, views from window).
- **Anomalies:** Anything broken, weird, funny, or culturally distinct.

**IMPORTANT:** You must process images **one by one**. Do not try to read or analyze multiple images in a single tool call or step, as this may cause the process to hang. Finish one image completely before moving to the next.

### 3. Determine Description Length (The 3 Tiers)

**Tier 1: The Label (Short)**
*Use for:* Generic views, simple objects, repeating themes.
*Length:* 1-3 words.
*Examples:*

- "Embankment."
- "Manhole."
- "Evening streets."
- "Street signs."

**Tier 2: The Observation (Medium)**
*Use for:* Things with a specific detail worth noting.
*Length:* 1-2 sentences.
*Examples:*

- "Walk-through passage on the green metro line."
- "Stop line for cyclists. And a button to trigger the light."
- "Access to the central pool is denied without a cap."

**Tier 3: The Story / Fun Fact (Long)**
*Use for:* Unique objects, funny signs, complex interactions (buying tickets), interactions with people, or cultural shocks.
*Length:* A paragraph or more.
*Examples:*

- A story about a funny bus driver who counted passengers.
- A detailed explanation of how a confusing ticket machine works or how you got a discount.
- A breakdown of a grocery receipt or a specific local product.
- *Instruction:* If the image triggers a specific fact (e.g., "This building looks like X but is actually Y") or a little story, write it down!

### 4. Output format

<code-snippet name="Example Output" lang="blade">
@ru
  <p>Tier 3: История о том, как я пытался купить билет в этом автомате. Экран тугой, карты не принимает. Пришлось звать помощь.</p>
@endru
IMG_1234.jpeg

@ru
  <p>Tier 1: Турникеты.</p>
@en
  <p>Turnstiles.</p>
@endru
IMG_1235.jpeg

@ru
  <p>Tier 2: Разметка на полу подсказывает, где стоять в очереди.</p>
@en
  <p>Floor markings suggest where to stand in line.</p>
@endru
IMG_1236.jpeg
</code-snippet>

### 5. Rules

- **Minimum Length:** Even "simple" descriptions should be at least a word or two. **Never leave it empty.** Tier 2 descriptions are the most welcome.
- **Language:** Both Russian (`@ru`) and English (`@en`) are mandatory.
- **Cleanup:** Delete lines for files that do not exist on disk.
- **Do not group:** Keep one description per image for now.
- **Image filenames:** Keep `IMG_xxxx.yyy` lines as is.

### 6. Translation & Localization

- **Smart Adaptation:** Do not translate blindly.
  - If the image contains English text and the Russian note explains it, do not translate that explanation back to English (it would be meaningless). Instead, provide context, a witty remark, or a different observation in English.
- **Currency:** English text shouldn't contain prices in RUB if the note is not about the country that uses RUB.

## Tools

To get metadata:

```
exiftool -json -g -n ~/Downloads/buffer/IMG_xxxx.jpeg
```
