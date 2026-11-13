# Notelist

Lightweight plaintext note manager built on [VC Framework](https://github.com/dsoos1290/vcframework) for PHP 5.3 and newer.

Notelist manages per-user notes in a simple, Notepad-style editor, with named lists and shared login alongside Lifelist, Playlist and Todolist.

## Features

* Per-user notes with creation, editing, renaming and deletion.
* Three note lists: **B**, **P** and **W**; empty lists stay hidden.
* Plaintext editor with a separate title and list selector.
* Move notes between lists by changing the list selector.
* Manual saving with a Save button or Ctrl+S / Cmd+S.
* Character count, unsaved-change warning and deletion confirmation.
* Shared user authentication, CSRF protection and flash messages.
* Responsive interface with no external frontend dependencies.
* MySQLi, optional database table prefixes, Apache URL rewriting and subdirectory support.
* No Composer dependency; PHP 5.3+ compatible.

## Requirements

* PHP 5.3+ with MySQLi.
* MySQL or MariaDB with InnoDB and utf8mb4 support.
* Apache with `mod_rewrite`.
* JavaScript-enabled browser for keyboard shortcuts, character counts and confirmation prompts.

## Installation

1. Download the [latest release](https://github.com/sdaniel1335/notelist/releases/latest) or clone the repository.
2. Place the application in a `notelist` subdirectory alongside the other apps on the same website, including the supplied `.htaccess` files.
3. Copy `private_html/app/config/db-sample.php` to `private_html/app/config/db.php` and configure the existing shared database. Set `DB_CHAR` to `utf8mb4`.
4. Import `install.sql` into that database. Existing users are preserved, and a `notes` table is created. If you use `DB_PREFIX`, apply the same prefix to the table names and references in the SQL before importing.
5. Configure the shared PHP session as described below, then sign in with an existing account. Notelist does not create a default account.
6. Create a note, choose its list, enter a title and save.

Keep `private_html` inaccessible to direct HTTP requests and set `APP_ENV` to `prod` for deployment.

## Shared login

Notelist uses the same `users` table and `auth_user_id`, `auth_username` and `_auth_csrf` session keys as Lifelist, Playlist and Todolist.

For shared login, run the apps on the same host with matching PHP session names, session storage and cookie settings. Set the session cookie path to `/` so it covers all application subdirectories. Signing out removes the shared authentication state.

The included `MODULE` marker lets the shared topbar discover Notelist alongside the other applications.

## Notes

Use **New note** to create a note, including when all lists are empty. Open an existing note to edit its text, rename it through the title field or move it to another list. Notes are ordered by title within each list.

Saving is manual. Empty note content is allowed; a title is required and may contain up to 255 UTF-8 bytes. Each note may contain up to 1 MiB of plaintext. Deletion is permanent.

## Configuration

* Application settings: `private_html/app/config/app.php` (`APP_URL` is optional).
* Database settings: `private_html/app/config/db.php` (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `DB_CHAR`, `DB_TIME`, `DB_PREFIX`, optional `DB_PORT`).
* Shared sessions: configure through the hosting environment's PHP session settings.
* The current interface is in Hungarian.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for the release history.
