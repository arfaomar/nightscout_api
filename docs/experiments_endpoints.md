# Experiments Endpoints

This document provides details about the API endpoints related to experiments.

## Test Endpoint

-   **Endpoint:** `GET /test`
-   **Description:** A simple test endpoint that returns a success status. This is primarily used for verifying API connectivity.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: A JSON object indicating a successful response.

### Example Response

```json
{
    "status": "ok"
}
```