# pweb_shortenerLink

> [!WARNING]
> **Archived. For educational purposes only. Do not deploy or use this code.**
> This was a 2018 university web programming assignment and has not received security updates. It contains known vulnerabilities, including SQL injection, plain-text password storage, missing authorization checks, and unsafe handling of user-supplied URLs.

A link shortener written in native PHP with MySQL, built in 2018 for the Web Programming (Pemrograman Web) course at Institut Teknologi Sepuluh Nopember (ITS).

## Features

- **Anonymous shortening**: paste a URL on the home page to get a 4-character short link
- **Accounts**: register and log in to manage your own links
- **Dashboard**: a table of your links loaded via Ajax with [Tabulator](http://tabulator.info), with edit, delete, and download actions
- **Custom links**: edit a link's title, short code, and destination
- **Branded redirect page**: upload a background image that's shown during a 5-second countdown before redirecting
- **Automatic titles**: fetches the destination page's `<title>` when a link is created

## Tech stack

PHP (PDO) · MySQL · Apache with `mod_rewrite` · JavaScript · Tabulator

## Project structure

```
index.php, home.php        public home page and user dashboard
login.php, register.php    authentication pages (logic in auth.php)
url_generator.php          create, edit, delete, and look up short links
r.php                      short link resolver (/r?c=<code>)
progressiveData.php        JSON data for the dashboard table
config.php                 database connection and view rendering
view/                      page templates
DEP.sql                    database schema
.htaccess                  extensionless URLs and session auto-start
```

## Known issues

These are documented as learning notes and will not be fixed:

- Queries build SQL from raw user input instead of using bound parameters (SQL injection).
- Passwords are stored and compared in plain text instead of with `password_hash`.
- Protected pages redirect without `exit`, so the rest of the page still runs for logged-out users.
- Links can be edited or deleted by ID without checking who owns them.
- The submitted URL is fetched server-side with `file_get_contents` without validation, which allows reading local files and requests to internal hosts (SSRF).
- Page titles and URLs are written into HTML and JavaScript without escaping (XSS, unsafe redirects).
- Database credentials are hardcoded in `config.php`.

## License

[MIT](LICENSE). Provided as-is, without warranty.
