# Nightscout Laravel API

A lightweight, Nightscout-compatible API in PHP (Laravel) that supports AndroidAPS.

---

## Project Description

Implements middleware in PHP that accepts requests to the Nightscout API and translates them into SQL database queries.
The middleware maintains the database according to API requests. The technology stack is chosen for cost-effective
hosting.

This project simulates the Nightscout API with Laravel and replaces MongoDB with SQL compatibility. It is built to
connect with AndroidAPS.

---

## Functional Requirements

- Implementation of the Nightscout V1 REST API in PHP
- Read requests must be available in the same formats as Nightscout (JSON, line-by-line output, etc.)
- PHP implementation of a document database emulation
- Creation of a test program to interact with the API (preferably using Swagger)

---

## Constraints

- The code must run on a classic web host (tested on Hetzner)
- The execution time of a write request—even with very large databases—must not exceed a few seconds (maximum 1 minute)
- The execution time of a read request with common search parameters must also only take a few seconds

---

## Optional Requirements (for higher grades)

- Demonstration with AndroidAPS as data source and nightscout-reporter as user interface → https://nightrep.zreptil.de/
- Implementation of auth tokens
- Support for Nightscout API V3
- Encapsulation of the database emulation as a standalone library including optimization

---

## Non-Functional Requirements

- Provision of a script to import datasets from a MongoDB
- Report on the experiments conducted and design decisions
- Documentation of the technologies used, so other students can easily get started
- Result logging and precise documentation of outcomes
- Provision of a prototype with detailed documentation for setup
- Provision of a Dockerfile and a docker-compose.yml

---

## Docs

- API documentation available in [swagger.yaml](./docs/swagger.yaml)
- Additional project documentation can be found in [docs/README.md](docs/README.md)

---

### Using Laravel Sail (Docker)

If you want to use Laravel Sail (Docker-based local development):

1. Start Sail:

```bash
cp .env.example .env
./vendor/bin/sail up -d
```

The application will be available at:  
`http://localhost:80`

2. Stop Sail:

```bash
./vendor/bin/sail stop
```

**Note:**  
Always prepend `./vendor/bin/sail` before any `artisan` or `composer` command when using Sail, e.g.:

```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail composer require <package>
```

For more information, see: https://laravel.com/docs/12.x/sail


---

## Getting Started (Local)

### 1. Clone the repository

```bash
git clone https://code.fbi.h-da.de/istkrsadl/nightscoutpse.git
cd NightscoutPSE
```

### 2. Install dependencies

```bash
composer install
cp .env.example .env
```

### 3. Start the server

```bash
php artisan serve
```

Server will then run at:  
`http://127.0.0.1:8000`

---

## Supported API Endpoints

| Category       | Path                            |
|----------------|---------------------------------|
| Entries        | `/api/entries`                  |
| Treatments     | `/api/treatments`               |
| DeviceStatus   | `/api/devicestatus`             |
| Profile        | `/api/profile`, `/profiles`     |
| Status         | `/api/status`                   |
| Activity       | `/api/activity`                 |
| Notifications  | `/api/notifications/*`          |
| AdminNotifies  | `/api/adminnotifies`            |
| VerifyAuth     | `/api/verifyauth`               |
| Alexa / Google | `/api/alexa`, `/api/googlehome` |
| Root           | `/api/versions`                 |

---

## Structure

```bash
app/Http/Controllers/       # All API controllers
routes/api.php              # All API routes (Nightscout-compatible)
storage/debug/              # JSON files for stored data
```

---

## Project Team

- Omar Ibrahim Arfa
- Elyes Lachal
- Simon Pototzki
- Krystian Sadlo
- Aiham Zaria
