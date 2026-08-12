---
paths:
  - 'resources/views/**'
---

# Views

## Blade view composition
Use anonymous Blade components for reusable UI primitives with attributes or slots. Use @include partials for page assembly and repeated content or media fragments.

## Localization strategy
Use inline @ru/optional @en blocks for long-form Blade prose, Russian JSON source keys for standalone UI copy, and dotted PHP keys for grouped domain, validation, mail, metadata, and admin strings.

## Use locale-aware URL helpers
Use path() for controller-action destinations and to() for URI templates or literal paths. Reserve url() for making an existing path absolute; do not replace these helpers with route() or action().
