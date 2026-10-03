# Project Context: ivacuum/hosting

## Project Overview

This is a Laravel application serving as a personal website for notes, trip stories, and concert history. Production runs on a modest FreeBSD server under high load; keep CPU, memory, and database costs in mind.

## Architecture & Conventions

- **Models:** Located in the root of `app/` (e.g., `app/User.php`) and in `app/Domain/*/Models/`. Migration of root-level models to `app/Models/` is planned but deferred.
- **Actions:** Business logic is encapsulated in Action classes within `app/Action/` and `app/Domain/*/Action/`. When creating new logic, check if it fits into an Action class.
- **Domains:** Keep domain-specific functionality together under `app/Domain/`. Prefer extending an existing domain and follow its internal structure.
- **Seeders:** Located in `app/Seeder/` and `app/Domain/*/Seeder/` (not `database/seeders`).
- **Livewire:** Components in `app/Livewire/` and `app/Domain/*/Livewire/`.
- **Factories:** Use the custom immutable builders in `app/Factory/` and `app/Domain/*/Factory/`. Never use Eloquent factories, including in tests and seeders.
- **ADR:** Architectural Decision Records are stored in `adr/` in Russian.
- **Eloquent:** Rely on automatic relationship eager loading. Use explicit `with()` only to restrict or shape related data, not defensively.
- **Migrations:** Always delete the `down` method from database migrations.
- **Long-running workers:** Keep new and modified code compatible with long-running workers, regardless of whether Octane is adopted. Never retain request or user state in long-lived objects or statics; use scoped bindings for per-request services.

## Test scope

- Verify every code change using appropriate existing tests or checks.
- Minimize the number of retained tests. Every test adds maintenance and review cost; more tests are not inherently better.
- Inspect existing coverage first. Prefer extending an existing test, and add no tests when existing coverage adequately protects the change.
- For a bug fix, aim for one focused regression test. For a feature, cover its core behavior with the smallest possible set.
- Add another test only for a distinct, realistic failure that the other tests would miss. Skip speculative edge cases, equivalent input variations, framework guarantees, and assertions that merely mirror the implementation.
- Stop once the changed behavior and its important risks are covered. Do not expand coverage merely because related code is nearby.
- Temporary tests or checks may be used for verification without being retained. Before finishing, review newly added tests and remove disposable checks.
- Leave unrelated tests alone. Within the task’s scope, remove or consolidate redundant tests while preserving coverage of distinct, realistic failures.
- In the final response, briefly explain what new coverage protects and report temporary verification separately from retained tests.

## Guidelines

- Before creating or changing tests, read `.agents/guidelines/tests.md`.
- Before analyzing or changing metrics, read `.agents/guidelines/metrics.md`. `App\Events\Stats\*` events use a wildcard listener; missing per-event listeners do not mean an event is unused.

## Key Commands

Prefix every Composer and Artisan command with `AI_AGENT=1` for Laravel Pao’s concise, agent-friendly output, even when examples omit it.

### Development

- **Start Environment:** `docker-compose up -d`
- **Frontend Dev:** `yarn dev`
- **Frontend Build:** `yarn build`
- **Code Analysis:** `composer pint` (full-project style formatting), `composer rector` (refactoring dry run)

### Database

- **Reset & Seed:** `composer fresh` should restore a known initial development state, independent of any previously accumulated data.

### Testing

- **Targeted verification:** Run the narrowest relevant test file or filter: `php artisan test --compact --no-interaction <path>` or `php artisan test --compact --no-interaction --filter=<name>`.
- **Full suite:** `composer test` (parallel execution).
- **Full suite with recreated test databases:** `composer test-fresh`.
- Use targeted verification by default. Broaden testing when the change affects shared behavior or targeted results leave a concrete concern unresolved.

## I18n

Translations are done either in Laravel traditional way using `__(key)` or using the following syntax:

```blade
\@ru
  Русский текст.
\@en
  English text.
\@endru
```

Russian is the default language of this project. English is optional. When translating, keep the author style.

## Framework Guidance

The project-specific conventions above specialize the general framework guidance below.

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application running on PHP 8.5. You are an expert with the Laravel ecosystem. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:

- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `yarn run build`, `yarn run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists (settled decisions, non-obvious traps, standing constraints). Framework and package guidelines that only apply to specific paths (testing, frontend, components) also live there, under `.ai/rules/boost` — this is not just recorded decisions, it is load-bearing guidance you have not seen inline. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.
- Record a rule with `record-rule` only when the user explicitly asks for one. Instructions for the work at hand are not rules, no matter how emphatic: "remove this typo", "use X here" are work to do, not rules to record. Never record a rule on your own initiative, as a byproduct of a change, or to summarize what you just did. When the user does ask, pass a `glob` (e.g. `app/Http/Controllers/**`), a short `title`, and a few-line `note`. Use `record-rule` rather than your native memory or notes tool, because native memory is personal and session-scoped, while only `.ai/rules` is shared with the team and persists in the repo.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== tests rules ===

# Test Enforcement

- Run the affected tests and ensure they pass.
- Test the changed behavior and its important failure modes, but do not add tests beyond them.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, never use named routes or the `route()` function, except `signedRoute()`.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If Vite reports a missing manifest entry, check that the referenced source file exists and is configured correctly. Rebuild with `yarn build` when the manifest is stale.

=== livewire/core rules ===

# Livewire

- Livewire allows you to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --dirty --format agent` to fix any formatting issues.

=== phpunit/core rules ===

# PHPUnit

- This project uses PHPUnit. Create tests with `php artisan make:test --phpunit {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/phpunit` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

</laravel-boost-guidelines>
