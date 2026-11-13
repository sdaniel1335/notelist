# Changelog

All notable changes to this project will be documented in this file.

## [0.1.0] - 2026-11-13

### Added

- Initial Notelist application built on VC Framework with PHP 5.3+ compatibility.
- MySQLi-backed per-user plaintext notes with creation, editing, renaming and deletion.
- B, P and W note lists, displayed only when they contain at least one note.
- Note ordering by title and movement between lists through the editor.
- Notepad-style editor with separate title and content fields.
- Manual saving with Ctrl+S / Cmd+S support and a character count.
- Unsaved-change warnings and deletion confirmation.
- Shared login with Lifelist, Playlist and Todolist using the existing users table and PHP session.
- CSRF protection, user-scoped database operations and flash messages.
- Responsive Hungarian interface without external frontend dependencies.
- Optional database table prefixes, absolute application URL and subdirectory support.
- Apache URL rewriting and module discovery through the shared topbar.
- No Composer dependency.
