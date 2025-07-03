# Google Home Endpoints

This document provides details about the API endpoints related to Google Home integration.

## Handle Google Home Requests

-   **Endpoint:** `POST /googlehome`
-   **Description:** Handles requests from Google Home. It can respond to intents like getting the current glucose value or the last insulin intake.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** The request body sent by the Google Home service.
-   **Responses:**
    -   The response format is specific to the Google Assistant platform.

### Example Request

```json
{
    "queryResult": {
        "intent": {
            "displayName": "GetGlucoseIntent"
        }
    }
}
```

### Example Response

```json
{
    "fulfillmentText": "The current glucose value is 120 mg/dl.",
    "source": "Laravel-Nightscout-API"
}
```
