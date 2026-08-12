---
paths:
  - 'app/Http/**'
---

# Http

## Validate HTTP input with Form Requests
Validate controller-bound HTTP input with dedicated Form Request classes; do not validate inline in controllers.

## Return JSON responses as plain arrays
Return plain arrays from JSON endpoints and let Laravel serialize them; do not introduce API Resources or explicit response()->json() wrappers unless an array cannot provide required behavior.

## Use locale-aware URL helpers
Use path() for controller-action destinations and to() for URI templates or literal paths. Reserve url() for making an existing path absolute; do not replace these helpers with route() or action().
