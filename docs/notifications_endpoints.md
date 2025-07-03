# Notifications Endpoints

This document provides details about the API endpoints related to notifications.

## Pushover Callback

- **Endpoint:** `POST /notifications/pushovercallback`
- **Description:** Handles callbacks from the Pushover notification service. This endpoint is primarily for receiving
  data from Pushover.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** The request body sent by the Pushover service. The exact structure depends on the Pushover
  notification type.
- **Responses:**
    - `200 OK`: A JSON object confirming receipt of the callback.

### Example Request Body (from Pushover)

```json
{
    "token": "<pushover_token>",
    "user": "<pushover_user_key>",
    "message": "Your glucose is 120 mg/dL",
    "title": "Nightscout Alert"
}
```

### Example Response

```json
{
    "message": "POST /notifications/pushovercallback received",
    "received": {
        "token": "<pushover_token>",
        "user": "<pushover_user_key>",
        "message": "Your glucose is 120 mg/dL",
        "title": "Nightscout Alert"
    }
}
```

## Acknowledge a Notification

- **Endpoint:** `GET /notifications/ack`
- **Description:** Acknowledges a notification. This endpoint is a placeholder and currently returns a simple OK status.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
    - `200 OK`: A JSON object indicating success.

### Example Response

```json
{
    "status": "OK"
}
```
