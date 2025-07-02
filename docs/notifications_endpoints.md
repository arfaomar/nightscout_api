# Notifications Endpoints

This document provides details about the API endpoints related to notifications.

## Pushover Callback

- **Endpoint:** `POST /notifications/pushovercallback`
- **Description:** Handles callbacks from the Pushover notification service.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** The request body sent by the Pushover service.
- **Responses:**
  - `200 OK`

## Acknowledge a Notification

- **Endpoint:** `GET /notifications/ack`
- **Description:** Acknowledges a notification.
- **Authentication:** Required (see [Authentication](Authentication.md))
- **Responses:**
  - `200 OK`