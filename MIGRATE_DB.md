# Database Migration using Migrate DB Pro

Use the below instructions to sync your local environment databaes with the database from our WPEngine Development environment.

## Installation

If you don't have it on your local and remote environments, add and activate the [Migrate DB Pro](https://deliciousbrains.com/wp-migrate-db-pro/) plugin. Login to access the license key.

The documentation below pertains to this specific project, but additional documentation is available on [their website](https://deliciousbrains.com/wp-migrate-db-pro/doc/quick-start-guide/).

## To Pull from Development

Pulls Database from: https://csisjtidev.wpengine.com/

1. On your local install, go to Tools --> Migrate DB Pro --> Migrate
2. Click "Pull" to replace this site's db with remote DB
3. From the Development Dashboard, go to Tools --> Migrate DB Pro --> Settings, and copy the the "Connection Info" and paste it into the local "Connection Info" box.
4. It should update the Find & Replace values automatically. If it doesn't, follow this pattern (change as needed):

- Find: `//csisjtidev.wpengine.com` replace with `//energy-jti.local`
- Find: `/nas/content/live/csisjtidev` replace with `/Users/jschrag/Local Sites/energy-jti/app/public`

5. You can optionally change the pull settings (eg. only pull specific table rows)
6. Save the migration profile for easier transfers in the future.
