# phingthings

Some simple Phing-Tasks and build scripts that come in handy from time to time.

## SymfonySync - Deploy a symfony app to production server via FTP

This task handles the process of ftp-syncing all data to the production server.

Excluded from syncing are:

  - app/config/parameters.yml
  - var/cache
  - var/logs
  - app/cache
  - app/logs
  - vendor
  - composer.lock
  - build.xml