# Testing guidelines

Test observable behavior, not implementation details. Modernize tests incrementally and leave unrelated coverage unchanged.

## Test data

- Use explicit, deterministic inputs and expected results for the scenario. Give similar fields clearly different values.
- Do not create a model just to reuse its factory-generated attributes as form input. Submit explicit values and assert the persisted result independently.
- Use project factories in `app/Factory` and `app/Domain/*/Factory`. Create only the model graph and supporting data the test needs. Never use Eloquent factories.
- Do not depend on test order, fixed IDs, seeded rows, or an empty database. Do not depend on unrestricted `first()` or `latest()` queries, random values, or the real clock.
- Freeze time when behavior depends on it. Test random behavior through invariants rather than specific random outputs.

## Location

- Tests that call Laravel routes go to `tests/Feature`.
- Livewire component tests go to `tests/Livewire`.
- Job tests go to `tests/Job`.
- Isolated logic without routes or external infrastructure goes to `tests/Unit`.

## Database and style

- Use `DatabaseTransactions` in every test that may write to the database. The test database can contain valuable local data.
- Within each file, group methods by visibility in the order `public`, `protected`, `private`. Sort each group alphabetically.
