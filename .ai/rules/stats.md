---
paths:
  - 'app/Events/Stats/**'
---

# Stats

## Stats events use the wildcard metrics pipeline
Treat App\Events\Stats\* classes as metric signals handled by the wildcard metrics listener; do not add per-event listeners or treat them as unused.
