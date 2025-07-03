# Verify Auth Endpoints

This document provides details about the API endpoints related to verifying authentication.

## Verify Authentication

-   **Endpoint:** `GET /verifyauth`
-   **Description:** Verifies the authentication status of the current request based on the provided `Authorization` header, `token` query parameter, or `api-secret` header. It indicates whether the authenticated user has read, write, or admin permissions.
-   **Authentication:** Optional (the endpoint itself is used to verify authentication, so it can be called without prior authentication attempts).
-   **Responses:**
    -   `200 OK`: A JSON object detailing the authentication status and permissions.

### Example Authenticated Response

```json
{
    "canRead": true,
    "canWrite": true,
    "isAdmin": true,
    "message": "OK",
    "rolefound": "FOUND",
    "permissions": "ROLE"
}
```

### Example Unauthenticated Response

```json
{
    "canRead": false,
    "canWrite": false,
    "isAdmin": false,
    "message": "UNAUTHORIZED",
    "rolefound": "NOT_FOUND",
    "permissions": "DEFAULT"
}
```