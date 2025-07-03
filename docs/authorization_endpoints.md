# Authorization Endpoints

This document describes the endpoints for obtaining a JSON Web Token (JWT) for authentication.

## Request a Token

To request a JWT, you need to make a GET request to one of the following endpoints, providing your `API_SECRET` as part of the URL.

-   `GET /api/v2/authorization/request/{apiSecret}`
-   `GET /api/v2/authorization/request/token={apiSecret}`

### Parameters

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `apiSecret` | `string` | **Required**. Your `API_SECRET`. |

### Successful Response

A successful request will return a `200 OK` status code and a JSON object containing the JWT and its details.

```json
{
    "token": "<your_jwt_token>",
    "sub": "admin",
    "permissionGroups": [
        ["*"],
        ["*:*:read"]
    ],
    "iat": 1678886400,
    "exp": 1678890000
}
```

### Error Response

If the provided `apiSecret` is invalid, the API will respond with a `403 Forbidden` status code and the following JSON response:

```json
{
    "message": "Invalid API Secret"
}
```
