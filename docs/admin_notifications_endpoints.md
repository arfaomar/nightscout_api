# Admin Notifications Endpoints

This document provides details about the API endpoints related to admin notifications.

## Get All Admin Notifications

-   **Endpoint:** `GET /adminnotifies`
-   **Description:** Retrieves a list of all admin notifications. **Note:** This endpoint currently returns a hardcoded response and does not retrieve actual notifications from a database.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: A JSON object containing a `notifies` array (currently empty) and a `notifyCount`.

### Example Response

```json
{
    "status": 200,
    "message": {
        "notifies": [],
        "notifyCount": 2
    }
}
```