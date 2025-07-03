# Nightscout API Documentation

## Overview

This document provides a comprehensive technical reference for all Nightscout API endpoints, including routes,
parameters, authentication, behaviors, and example usage.

---

## Table of Contents

- [Activity API Endpoints](#activity-api-endpoints)
- [Alexa API Endpoint](#alexa-api-endpoint)
- [DeviceStatus API Endpoints](#devicestatus-api-endpoints)
- [Entries API Endpoints](#entries-api-endpoints)
- [Experiments API Endpoint](#experiments-api-endpoint)
- [Food API Endpoints](#food-api-endpoints)
- [Google Home API Endpoint](#google-home-api-endpoint)
- [Profiles API Endpoints](#profiles-api-endpoints)
- [Treatments API Endpoints](#treatments-api-endpoints)
- [Status API Endpoint](#status-api-endpoint)
- [Admin Notifications API Endpoint](#admin-notifications-api-endpoint)
- [Notifications API Endpoints](#notifications-api-endpoints)
- [Root API Endpoint](#root-api-endpoint)
- [Main API Router](#main-api-router)
- [Verify Authorization API Endpoint](#verify-authorization-api-endpoint)

---

## Activity API Endpoints

> All endpoints require authorization and are only enabled if both `api` and `careportal` features are enabled.

### GET /activity

Returns a list of activity data. Supports query parameters via `ctx.activity.list`. Supports `If-Modified-Since` for
caching.

### POST /activity/

**Description:** Create one or more activity records.

**Authorization:** Requires `api:activity:create`.

**Request Body:**

```json
[
    {
        "eventType": "Exercise",
        "duration": 30,
        "created_at": "2025-06-19T10:00:00Z"
    }
]
```

**Response:**

```json
[
    {
        "_id": "abc123",
        "eventType": "Exercise",
        "duration": 30,
        "created_at": "2025-06-19T10:00:00Z"
    }
]
```

Creates one or more activity records. Requires `api:activity:create`.

### DELETE /activity/:_id

**Description:** Delete an activity record by its `_id`.

**Authorization:** Requires `api:activity:delete`.

**Response:**

```json
{}
```

Deletes an activity record by its `_id`. Requires `api:activity:delete`.

### PUT /activity/

**Description:** Update an existing activity record.

**Authorization:** Requires `api:activity:update`.

**Request Body:**

```json
{
    "_id": "abc123",
    "eventType": "Exercise",
    "duration": 45
}
```

**Response:**

```json
{
    "_id": "abc123",
    "eventType": "Exercise",
    "duration": 45,
    "created_at": "2025-06-19T10:00:00Z"
}
```

Updates an existing activity record. Requires `api:activity:update`.

---

## Alexa API Endpoint

### POST /alexa

Handles Alexa Skill Kit requests (LaunchRequest, IntentRequest, etc.) and responds with valid Alexa responses.

- Requires `api:*:read` permission
- Accepts JSON body with Alexa's request format
- Returns Alexa-compatible JSON response

Example:

```json
{
    "request": {
        "type": "IntentRequest",
        "locale": "en-US",
        "intent": {
            "name": "GetGlucoseIntent",
            "slots": {
                "metric": {
                    "name": "metric",
                    "value": "glucose"
                }
            }
        }
    }
}
```

---

## DeviceStatus API Endpoints

### GET /devicestatus/

Returns recent device status records. Supports `count` and query filters.

### POST /devicestatus/

Creates a new device status record. Requires `api:devicestatus:create`.

### DELETE /devicestatus/:id

Deletes a device status record by ID. Requires `api:devicestatus:delete`.

### DELETE /devicestatus/

Deletes one or more records using query parameters.

---

## Entries API Endpoints

### GET /entries

Returns CGM entries. Supports filtering with `find` and `count`.

### GET /entries/current

Returns the most recent entry.

### GET /entries/:spec

Returns entry by ID or type.

### POST /entries/

Creates new entries. Requires `api:entries:create`.

### POST /entries/preview

Validates entries without saving. Requires `api:entries:create`.

### DELETE /entries/:spec

Deletes entry by ID or type. Requires `api:entries:delete`.

### DELETE /entries/

Deletes entries via query. Requires `api:entries:delete`.

### Special Routes:

- `GET /times/:prefix/:regex`
- `GET /slice/:storage/:field/:type/:prefix/:regex`
- `GET /echo/:echo/:model/:spec`

---

## Experiments API Endpoint

### GET /test

Test/debug endpoint. Requires `authorization:debug:test`. Returns `{ "status": "ok" }`.

---

## Food API Endpoints

Includes GET, POST, PUT, DELETE under `/food/`.

- Public: `GET /food/`, `/quickpicks`, `/regular`
- Protected:
    - `POST /food/` → `api:food:create`
    - `PUT /food/` → `api:food:update`
    - `DELETE /food/:_id` → `api:food:delete`

---

## Google Home API Endpoint

### POST /googlehome

Handles requests from Google Home via Dialogflow.

- Requires `api:*:read`
- Parses intent, language, and metric
- Responds using `ctx.googleHome.buildSpeechletResponse()`

---

## Profiles API Endpoints

### GET /profiles/

Returns profile list. Optional `count`.

### GET /profile/

Returns profile attributes. Optional `count`.

### GET /profile/current

Returns current active profile.

### POST /profile/

Creates a profile. Requires `api:profile:create`.

### PUT /profile/

Updates a profile. Requires `api:profile:update`.

### DELETE /profile/:_id

Deletes a profile. Requires `api:profile:delete`.

---

## Treatments API Endpoints

### GET /treatments

Returns treatment records. Supports `count` and filters.

### POST /treatments/

Creates one or more treatments.

### DELETE /treatments/:id

Deletes treatment by ID. Supports wildcard with `find`.

### DELETE /treatments/

Deletes treatments using query filters.

### PUT /treatments/

Updates a treatment record.

---

## Status API Endpoint

### GET /status

Returns API/server status, version, time, and enabled features.

- Supports formats: HTML, JSON, PNG, SVG, JavaScript, Text
- Query: `token` or `secret` (optional)

Example JSON:

```json
{
    "status": "ok",
    "name": "Nightscout",
    "version": "x.y.z",
    "serverTime": "2025-06-19T13:00:00.000Z",
    "serverTimeEpoch": 1750347600000,
    "apiEnabled": true,
    "careportalEnabled": true,
    "boluscalcEnabled": false,
    "settings": {},
    "extendedSettings": {},
    "authorized": true,
    "runtimeState": {}
}
```

---

## Admin Notifications API Endpoint

### GET /adminnotifies

Returns notifications for admin users, or just count for others.

Example (admin):

```json
{
    "notifies": [
        {
            "<object>": {}
        }
    ],
    "notifyCount": 1
}
```

---

## Notifications API Endpoints

### POST /notifications/pushovercallback

Processes Pushover acknowledgments.

### GET /notifications/ack

Acknowledges a notification. Requires `notifications:*:ack`.

---

## Root API Endpoint

### GET /versions

Returns available API versions.

Example:

```json
[
    {
        "version": "v1",
        "url": "/api/v1"
    },
    {
        "version": "v2",
        "url": "/api/v2"
    },
    {
        "version": "v3",
        "url": "/api/v3"
    }
]
```

---

## Main API Router

- Enables API if API key is present
- Registers feature modules under respective paths:
    - `/entries`, `/treatments`, `/profile`, `/food`, etc.
- Always includes `/verifyauth`, `/adminnotifies`
- Uses middleware from `ctx.wares`
- Supports formats: JSON, SVG, PNG, TXT, CSV, HTML, TSV

---

## Verify Authorization API Endpoint

### GET /verifyauth

Checks the requester's access rights.

Response:

```json
{
    "canRead": true,
    "canWrite": false,
    "isAdmin": false,
    "message": "OK",
    "rolefound": "FOUND",
    "permissions": "ROLE"
}
```
