# Testing Guidelines

Tests describe observable behavior, not implementation details. When modernizing tests, improve them incrementally without rewriting unrelated coverage.

## Test Data

- Use explicit, deterministic values for inputs and expected results relevant to the scenario. Use clearly different values for similar fields.
- Do not create a model only to reuse its factory-generated attributes as form input. Submit explicit values and independently assert the persisted result.
- Use project factories from `app/Factory` and `app/Domain/*/Factory` only to build the minimum valid model graph and incidental data. Never use Eloquent factories.
- Do not depend on test order, fixed IDs, seeded rows, an empty database, unrestricted `first()` / `latest()`, random values, or the real clock.
- Freeze time when it affects behavior. Test randomness through invariants rather than expecting a random value.

## Location

- Tests that hit Laravel routes go to `tests/Feature`.
- Livewire component tests go to `tests/Livewire`.
- Job tests go to `tests/Job`.
- Isolated logic without routes or external infrastructure goes to `tests/Unit`.

## Database and Style

- Use `DatabaseTransactions` in every test that may write to the database, because tests run against a database that can contain valuable local state.
- Sort methods by visibility (`public`, `protected`, `private`), then alphabetically within each file.
