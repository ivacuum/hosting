---
paths:
  - 'app/*.php'
  - 'app/**/*Action.php'
  - 'app/**'
  - 'app/**/*Job.php'
---

# App

## Model authorization lives in policies
Implement model authorization in Policy classes and associate models with #[UsePolicy]; do not define model abilities as gates.

## Actions use execute
Name business-operation classes with the Action suffix, expose the operation through execute(), and constructor-inject reusable collaborators.

## Build queries directly with Eloquent
Build queries directly with Eloquent where needed; do not introduce repositories or full query objects. Extract reusable predicates as invokable Scope objects.

## Invokable Eloquent query scopes
Implement reusable query conditions as invokable *Scope classes accepting Builder, and apply them with tap(new ...Scope(...)) or as conditional builder callbacks.

## Model event observers
Put Eloquent lifecycle handling in observer classes and register observers on models with #[ObservedBy]; do not register them in providers or booted() closures.

## Automatic Eloquent eager loading
Rely on automaticallyEagerLoadRelationships() instead of adding with() defensively. Use explicit eager loading only to shape or restrict the relationship query or loaded set.

## Jobs extend the application base
Make every concrete application job extend App\Jobs\AbstractJob; keep shared queue behavior in that base.

## Prefer Laravel global helpers
Prefer Laravel global helpers such as config(), auth(), request(), response(), view(), and redirect() over facade equivalents.

## Localization strategy
Use Russian JSON source keys for standalone UI copy and dotted PHP keys for grouped domain, validation, mail, metadata, and admin strings.

## Use PHP enums over database enums
Store enum-backed attributes in scalar string or integer columns and cast them to PHP enums in models; do not use database enum columns.

## Use collection pipelines for transformations
Use Laravel collection pipelines for in-memory mapping, filtering, and reduction. Keep foreach for side effects, mutation, streaming, or imperative aggregation.

## Use immutable application dates
Use CarbonImmutable for explicitly typed or constructed application dates; Laravel date helpers already return immutable dates through the configured Date facade.
