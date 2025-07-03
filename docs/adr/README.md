# Architecture Decision Log (ADL)
This directory contains the Architecture Decision Records (ADRs) for the **PSE Nightscout API Emulation** project. Collectively, these ADRs form our Architecture Decision Log (ADL).

## About This Project
This PSE project implements a PHP-based emulation of the Nightscout V1 REST API, including a document database emulation and tools for onboarding/testing. The goal is to provide a lightweight, portable alternative that works on classical web hosting (e.g., Hetzner), along with comprehensive documentation and onboarding for future students.

**See:** [`/docs/README.md`](../README.md) for a full project overview and onboarding instructions.

## About This Log
- Each file in this directory documents a significant design or technology decision made during the project, including the reasoning, alternatives considered, and implications.
- The ADL helps future maintainers, students, and reviewers understand *why* things were done a certain way—supporting both project transparency and grading.
- For more on the ADR process, see [Michael Nygard's ADR guide](https://cognitect.com/blog/2011/11/15/documenting-architecture-decisions.html).

## Index
Please list new ADRs here, using the filename format: `NNNN-title.md` (e.g., `0001-db-emulation.md`).

| ADR Filename                                       | Summary                                                                | Status       | Date    |
| -------------------------------------------------- | ---------------------------------------------------------------------- | ------------ | ------- |
| [0001-php-framework.md](0001-php-framework.md)     | PHP Framework Choice (Laravel)                                         | `Accepted`   | 2025-04 |
| [0002-dev-environment.md](0002-dev-environment.md) | Development Environment Choice (Laravel Sail)                          | `Accepted`   | 2025-04 |
| [0003-db.md](0003-db.md)                           | Database Technology Choice (MySQL)                                     | `Superseded` | 2025-04 |
| [0004-rtc.md](0004-rtc.md)                         | Real-Time Communication: Node.js Socket.IO Bridge                      | `Accepted`   | 2025-05 |
| [0005-nosql-emulation.md](0005-nosql-emulation.md) | NoSQL Database Emulation Approach (Eloquent ORM)                       | `Superseded` | 2025-06 |
| [0006-db.md](0006-db.md)                           | Database Technology Choice (PostgreSQL)                                | `Accepted`   | 2025-06 |
| [0007-nosql-emulation.md](0007-nosql-emulation.md) | NoSQL Database Emulation Approach<br>(Flexible extra_data JSON Column) | `Accepted`   | 2025-07 |

## How to contribute
- When a significant architectural or technical decision is made, create a new ADR in this folder.
- Use the provided ADR template ([`template.md`](template.md)) for consistency.
- Name your file following the format: `NNNN-title.md` (e.g., `0001-db-emulation.md`).
- Update the index table above with your ADR.