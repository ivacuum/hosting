---
paths:
  - 'app/Domain/*/Policy/**'
  - 'app/Policies/**'
---

# Policies

## Model authorization lives in policies
Implement model authorization in Policy classes and associate models with #[UsePolicy]; do not define model abilities as gates.
