---
paths:
  - 'app/Domain/*/Observer/**'
  - 'app/Observers/**'
---

# Observers

## Model event observers
Put Eloquent lifecycle handling in observer classes and register observers on models with #[ObservedBy]; do not register them in providers or booted() closures.
