# Authorization Endpoints

This document provides details about the API endpoints related to authorization.

## Request an Authorization Token

- **Endpoint:**
  - `GET /v2/authorization/request/{apiSecret}`
  - `GET /v2/authorization/request/token={apiSecret}`
- **Description:** Requests an authorization token.
- **Authentication:** None
- **URL Parameters:**
  - `apiSecret` (required): The API secret.
- **Responses:**
  - `200 OK`: A JSON object containing the authorization token.