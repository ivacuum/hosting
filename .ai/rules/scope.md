---
paths:
  - 'app/Domain/*/Scope/**'
  - 'app/Scope/**'
---

# Scope

## Invokable Eloquent query scopes
Implement reusable query conditions as invokable *Scope classes accepting Builder, and apply them with tap(new ...Scope(...)) or as conditional builder callbacks.
