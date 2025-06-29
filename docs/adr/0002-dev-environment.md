# Development Environment Choice

## Status
`Accepted`

## Context
A non-functional requirement of this project is to provide containerization, specifically by delivering a `Dockerfile` and `docker-compose.yml`. We want a solution that standardizes the development environment for all contributors, simplifies setup, and allows easy switching or modification of service components (like databases or queues). Seamless integration with Laravel is also important for our workflow.

## Decision
We chose **Laravel Sail** because it offers an out-of-the-box Docker setup for Laravel, manages the `docker-compose.yml` for us, and makes it easy to meet our containerization and standardization requirements.

## Consequences
- All contributors have a standardized, consistent development setup.
- Onboarding is fast and straightforward.
- Switching or adding services (like databases) is easy with Docker Compose.
- Environment variables are managed through the `.env` file and picked up by Sail automatically, reducing config headaches.
- Fewer environment-specific issues.
- Contributors need Docker installed and basic familiarity with it.
- Installing dependencies and setting up Docker can be confusing or frustrating if you’re not familiar with the process.

## Alternatives Considered
- **Native setup:** Fast, but risks inconsistency and dependency issues across machines.
- **Laravel Homestead:** Outdated and no longer maintained, so not a good option.
- **Custom Docker setup:** Flexible, but would require more effort; Sail already provides what we need.