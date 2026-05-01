# Testing Guidelines

Use `DatabaseTransactions` trait because app has some state after local usage — it shouldn't be lost.

## Location

Tests that hit Laravel routes, go to `tests/Feature`.

Livewire component tests go to `tests/Livewire`.

Tests that don't hit Laravel routes, go to `tests/Unit`.

Test methods should be sorted by visibility (public, protected, private), then alphabetically.
