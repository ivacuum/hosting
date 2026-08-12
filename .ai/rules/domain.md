---
paths:
  - 'app/Domain/**'
---

# Domain

## Plain readonly DTOs
Represent domain DTOs and transport payloads as plain readonly classes with typed constructor-initialized properties; do not introduce a DTO framework.

## Colocate code by bounded context
Place functionality belonging to an established domain beneath that domain, including its models, Actions, policies, jobs, listeners, factories, seeders, Livewire components, and delivery classes.

## Domain enum conventions
Place enums in the relevant domain context and use TitleCase cases. Back enums representing persisted or external scalar values; use pure enums when no scalar identity exists.
