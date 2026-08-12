---
paths:
  - 'tests/**'
---

# Tests

## Use project model builders
Create models with the project's immutable factory builders: new() creates the builder, make() returns an unsaved model, create() persists it, and modifiers return a clone. Do not use Eloquent factories.

## Use PHPUnit class-based tests
Write tests as PHPUnit classes extending the project TestCase; do not use Pest-style tests.

## Protect database state with transactions
Use DatabaseTransactions in every test that may write to the database; do not refresh, truncate, or migrate the test database.

## Isolate application collaborators with Mockery
Double application collaborators with Mockery, using the test-case mock() helper when the collaborator is container-resolved.
