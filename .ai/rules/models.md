---
paths:
  - 'app/Domain/*/Models/**'
  - 'app/Models/**'
---

# Models

## Model authorization lives in policies
Implement model authorization in Policy classes and associate models with #[UsePolicy]; do not define model abilities as gates.

## Invokable Eloquent query scopes
Implement reusable query conditions as invokable *Scope classes accepting Builder, and apply them with tap(new ...Scope(...)) or as conditional builder callbacks.

## Model event observers
Put Eloquent lifecycle handling in observer classes and register observers on models with #[ObservedBy]; do not register them in providers or booted() closures.

## Use PHP enums over database enums
Store enum-backed attributes in scalar string or integer columns and cast them to PHP enums in models; do not use database enum columns.
