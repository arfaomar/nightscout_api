# PHP Framework Choice

## Status
`Accepted`

## Context
We need to quickly and reliably implement the Nightscout API in PHP, following project constraints for hosting, performance, and maintainability. Using a modern PHP framework will help us work faster and keep the codebase clean for future contributors.

## Decision
We chose **Laravel** as our PHP framework. It offers strong tools for API development, good documentation, and a large community. This will help us build the project efficiently and keep the code easy to maintain.

## Consequences
- Faster and easier API development, even though the team was new to Laravel and PHP APIs.
- Minimal setup required, allowing us to get started quickly.
- Built-in ORM (Eloquent), routing, and middleware make handling data and API endpoints straightforward.
- Online documentation and community support helped us learn as we went.
- Good support for testing and API authentication out of the box.
- Some extra overhead compared to plain PHP, but the benefits outweigh it.
## Alternatives Considered
- **Vanilla PHP:** Would give us maximum control and might be easier to deploy on Hetzner, since it’s lightweight and has no extra dependencies. However, we’d have to build routing, validation, and authentication from scratch, slowing us down. The speed and development benefits of Laravel are more valuable to us for this project.
- **Symfony:** Very powerful, but more complex and harder to learn. Requires more setup for simple APIs. For our timeline and experience level, Laravel was easier and faster to use.