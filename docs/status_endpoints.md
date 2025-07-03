# Status Endpoints

This document provides details about the API endpoints related to system status.

## Get System Status

-   **Endpoint:** `GET /status`
-   **Description:** Retrieves the current status of the system.
-   **Authentication:** None
-   **Responses:**
    -   `200 OK`: A JSON object containing the system status.

### Example Response

```json
{
    "status": "ok",
    "name": "nightscout",
    "version": "15.0.2",
    "serverTime": "2023-07-28T12:00:00.000000Z",
    "serverTimeEpoch": 1690545600000,
    "apiEnabled": true,
    "careportalEnabled": true,
    "boluscalcEnabled": false,
    "settings": {},
    "extendedSettings": {},
    "authorized": null,
    "runtimeState": "loaded"
}
```
