---
paths:
  - 'app/Domain/*/Factory/**'
  - 'app/Factory/**'
---

# Factory

## Use project model builders
Create models with the project's immutable factory builders: new() creates the builder, make() returns an unsaved model, create() persists it, and modifiers return a clone. Do not use Eloquent factories.
