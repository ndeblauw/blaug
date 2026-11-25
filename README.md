# Blaug

Blaug is a small blog application built with Laravel as the demo project for a web development basics course. It has public pages for articles, authors, and categories, and a login-protected user zone where authors manage their own articles and comments, while admins also manage categories and moderate every comment. Comments are approved by moderation, and article authors get a queued email notification when a new comment awaits review.

The project intentionally keeps things simple: straightforward foreign keys, small controllers, Blade views, and no complex architecture.

## Requirements

- PHP 8.5
- Laravel 13

Packages that are not part of a standard Laravel install:
- `spatie/laravel-medialibrary` for article header images and user avatars

The frontend uses Tailwind CSS 4, Alpine.js, and Vite.

## Install on local development
Instructions below assume a setup like with Herd, where the site is available at directoryname.test. If you use different server, find it on localhost.

1. Clone the repository into your webserver directory, using `blaug` as the folder name so the site becomes available at `http://blaug.test`:

In Herd, for example
   ```bash
   cd ~/Herd
   git clone <repository-url> blaug
   cd blaug
   ```

2. Install the PHP dependencies:

   ```bash
   composer install
   ```

3. Create the environment file and generate the application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Create the SQLite database file (skip this if you configured another database in `.env`):

   ```bash
   touch database/database.sqlite
   ```

5. Run the migrations and seed the database. The seeder creates an admin, a test user, 75 authors, 100 articles, 200 comments, and attaches the demo images from `storage/seedings`:

   ```bash
   php artisan migrate --seed
   ```

6. Create the symbolic link so uploaded and seeded media is publicly available:

   ```bash
   php artisan storage:link
   ```

7. Install the frontend dependencies and build the assets:

   ```bash
   npm install
   npm run build
   ```

8. Open `http://blaug.test` in your browser. Herd serves the project automatically, so no `php artisan serve` is needed.

The seeded accounts both use `password` as their password:

- Admin: `nico@deblauwe.be`
- Regular user: `test@example.com`


### During development
We are using the Tailwind CSS CDN. If you switch to locally served frontend assets.
Run the Vite dev server so frontend changes are picked up:

```bash
npm run dev
```

Or start the server, queue listener, log viewer, and Vite together:

```bash
composer run dev
```

New comments trigger a queued notification to the article author. With the default `log` mail driver the email is written to `storage/logs/laravel.log`, and the queue listener started by `composer run dev` processes the job.

## Testing

The test suite uses Pest and an in-memory SQLite database:

```bash
php artisan test --compact
```
