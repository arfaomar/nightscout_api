# Verify Auth Endpoints

This document provides details about the API endpoints related to verifying authentication.

## Verify Authentication

- **Endpoint:** `GET /verifyauth`
- **Description:** Verifies the authentication of the current request.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: If the request is authenticated.
  - `401 Unauthorized`: If the request is not authenticated.