# Project Context: ivacuum/hosting

## Project Overview

This is a Laravel 12 application serving as a personal website for notes, trip stories, and concert history. It takes advantage of modern PHP features (8.4+), and Livewire for dynamic interactions. It is a production-grade app that serves pretty high-load on a modest server.

## Tech Stack

- **Language:** PHP 8.4+
- **Framework:** Laravel 12.x
- **Server:** PHP-FPM, Nginx
- **Frontend:** Vite 6, Tailwind CSS 4, Livewire 3, Vue 3
- **Database:** MySQL 8.4, Redis (Cache/Queue)
- **Search:** Sphinxsearch, Meilisearch (possible alternative)
- **Infrastructure:** Docker Compose

## Architecture & Conventions

The project follows a specific structure deviating slightly from standard Laravel defaults:

- **Models:** Located in the root of `app/` (e.g., `app/User.php`). Migration to `app/Models` folder is pending.
- **Actions:** Business logic is encapsulated in Action classes within `app/Action/` and `app/Domain/*/Action/`.
- **Domains:** Value Objects, Enums, and domain-specific logic reside in `app/Domain/`. Directories inside can mirror the Laravel directory structure convention.
- **Seeders:** Located in `app/Seeder/` and `app/Domain/*/Seeder/` (not `database/seeders`).
- **Livewire:** Components in `app/Livewire/` and `app/Domain/*/Livewire/`.
- **ADR:** Architectural Decision Records are stored in `adr/`.

## Key Commands

### Development

- **Start Environment:** `docker-compose up -d`
- **Frontend Dev:** `yarn dev`
- **Frontend Build:** `yarn build`
- **Code Analysis:** `composer pint` (Style), `composer rector` (Refactoring)

### Database

- **Reset & Seed:** `composer fresh` (Runs `migrate:fresh` and seeds using `App\Seeder\DatabaseSeeder`)

### Testing

- **Run Tests:** `composer test` (Parallel execution)
- **Run Tests (Fresh DB):** `composer test-fresh`

## Configuration

- **Env:** `.env` file (copy from `.env.example`).
- **Docker:** Services defined in `docker-compose.yml` (mysql, redis, meilisearch, nginx, php-fpm).
- **PHP:** Custom `Dockerfile` in root.

## I18n

Translations are done either in Laravel traditional way using `__(key)` or using the following syntax:

<code-snippet name="Example Output" lang="blade">
\@ru
  Русский текст.
\@en
  English text.
\@endru
</code-snippet>

Russian is the default language of this project. English is optional. When translating, keep the author style.

## Notes

- Act as a Senior Laravel Developer, Senior DevOps, and SRE.
- When creating new logic, check if it fits into an `Action` class.
- Respect the `app/Factory/` and `app/Domain/*/Factory/` location for Eloquent model factories.
- Respect the `app/Seeder/` and `app/Domain/*/Seeder/` location for database seeding.
- Try to use existing domain from `app/Domain/` if possible.
- Always delete `down` method from database migrations.
- Use `composer test` for verification, as it runs tests in parallel.
- Always use `composer fresh` instead of `php artisan db:seed`.
- Always write tests for new features and test new code.
- The project uses `laravel/octane`, so be mindful of state persistence in memory across requests if modifying bootstrapping logic.
