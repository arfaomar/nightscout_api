# NoSQL Database Emulation Approach

## Status
`Superseded`
*Superseded by [ADR-0007: NoSQL Database Emulation Approach](./0007-nosql-emulation.md)*

## Context
Our project requires emulating a document-oriented database (like MongoDB) in PHP. The initial idea was to use Laravel’s Eloquent ORM to define a flexible schema, allowing us to store documents as records and dynamically add columns if documents contain unexpected fields.  
We later explored FerretDB, which translates MongoDB queries to SQL, allowing us to use familiar MongoDB-style queries. However, FerretDB needs both a Docker container and the Postgres document DB extension—neither of which we can use with our Hetzner PHP hosting.  
We also considered MariaDB MaxScale, a proxy that converts MongoDB queries to SQL. However, this solution also requires separate hosting and is not possible within our project’s hosting constraints.

## Decision
We decided to use **Eloquent ORM** to create and manage our own dynamic schema in SQL. If a document contains new fields, we alter the table to add columns as needed. This approach works within our hosting limitations, requires no extra services, and leverages Laravel’s robust ORM capabilities.

## Consequences
- Our PHP application can emulate MongoDB-like flexibility using Eloquent and SQL tables.
- The schema can evolve dynamically to accommodate new fields found in incoming documents.
- No need for additional services, containers, or special database extensions—everything runs on standard PHP/MySQL hosting.
- Some MongoDB features (like nested or deeply unstructured data) may not be fully supported.
- Altering the table structure at runtime may introduce complexity and potential performance implications at scale.

## Alternatives Considered
- **FerretDB:** Allows MongoDB queries with SQL backend, but requires a Docker container and Postgres extension—neither is supported by our hosting provider.
- **MariaDB MaxScale:** Would be ideal for translating MongoDB queries to SQL, but also requires separate hosting, which is not possible for us right now. This remains our preferred option if hosting constraints change in the future.
- **Custom document store in SQL:** Considered but more complex and unnecessary since Eloquent plus dynamic schema already meets our needs.