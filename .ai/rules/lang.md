---
paths:
  - 'lang/*/validation.php'
  - 'lang/**'
---

# Lang

## Keep validation messages in language files
Define custom validation messages in lang/*/validation.php rather than Form Request messages() methods.

## Localization strategy
Keep standalone UI copy in JSON catalogs keyed by Russian source strings, and grouped domain, validation, mail, metadata, and admin translations in keyed PHP catalogs.
