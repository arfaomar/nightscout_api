# Root Endpoints

This document provides details about the root API endpoints.

## Get API Versions

-   **Endpoint:** `GET /versions`
-   **Description:** Retrieves the versions of the API. Note that this implementation only supports API v1.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: A JSON array containing the API versions.

### Example Response

```json
[
    {
        "version": "1.0.0",
        "url": "/api/v1"
    },
    {
        "version": "2.0.0",
        "url": "/api/v2"
    },
    {
        "version": "3.0.3-alpha",
        "url": "/api/v3"
    }
]
```