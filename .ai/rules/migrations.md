---
paths:
  - 'database/migrations/**'
---

# Migrations

## Defer foreign-key constraints
Declare foreign-key columns explicitly, then add constraints with foreign()->references()->on() after the tables have been created.

## Use PHP enums over database enums
Store enum-backed attributes in scalar string or integer columns and cast them to PHP enums in models; do not use database enum columns.
