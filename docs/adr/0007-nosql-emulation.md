# NoSQL Database Emulation Approach: extra_data JSON Column

## Status

`Accepted`
*Supersedes [ADR-0005: NoSQL Database Emulation Approach](./0005-nosql-emulation.md)*

## Context

Our goal is to emulate the Nightscout API’s document-like flexibility using PHP and PostgreSQL on classic web hosting (
Hetzner). Initially, we aimed to use Laravel’s Eloquent ORM with dynamic schema evolution: altering tables to add
columns for any new or unknown fields, and creating new tables for nested JSON objects, mapping relationships with
foreign keys.

However, we discovered several problems:

- Laravel’s Eloquent ORM is not designed for dynamic runtime schema changes or auto-generating nested tables. Handling
  this would require error-prone raw SQL and be very difficult to maintain.
- Managing migrations, keeping models and database in sync, and handling deeply nested or ever-changing data structures
  led to excessive complexity.

## Decision

We decided to:

- Use **Eloquent ORM** as our primary data access layer because it’s well-integrated into Laravel, supports
  migrations/seeding, and enforces security (SQL injection prevention).
- For each Nightscout API “collection” (endpoint), define a table with columns for known, frequently used fields.
- Add a single `extra_data` column of type `jsonb` to each table. All additional, less common, unknown, or nested fields
  from incoming JSON are serialized into this column as PostgreSQL, provides excellent support for JSONB fields and
  efficient querying when needed.

This approach gives us the best of both worlds: efficient and type-safe access for common data, and full flexibility for
document-style or evolving payloads.

## Consequences

- **Maintainability:** We avoid raw SQL and complex dynamic migrations. Eloquent ORM models remain simple and stable.
- **Flexibility:** New or unexpected fields and nested JSON objects are stored in `extra_data`, so Nightscout API
  evolution doesn’t break our storage model.
- **Querying:** We can efficiently query known fields as columns, and use PostgreSQL’s JSONB operators to access data in
  `extra_data` (though possibly less efficient than normal columns).
- **Security:** All queries are handled via Eloquent, using prepared statements.
- **Onboarding:** Future contributors familiar with Laravel can easily understand and extend the data model.

## Alternatives Considered

- **Raw SQL/Dynamic Schema:** Too tedious, error-prone, not supported by Eloquent ORM, and difficult to maintain.
- **Dedicated NoSQL Layer/FerretDB/MariaDB MaxScale:** Not possible with Hetzner’s hosting restrictions.
- **All-data-in-JSON only:** Would make querying and validation of common fields much harder and lose type safety for
  frequently used properties.

