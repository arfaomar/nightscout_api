# Authentication

This document describes the authentication methods for accessing the API endpoints.

## Authentication Methods

The API supports three methods of authentication. You can use any of the following methods to authenticate your requests.

### 1. Bearer Token (JWT)

You can authenticate by providing a JSON Web Token (JWT) in the `Authorization` header of your request.

**Header:**

```
Authorization: Bearer <your_jwt_token>
```

The JWT should be signed with the `HS512` algorithm using the `JWT_SECRET` configured in the application's environment.

### 2. API Secret as a Query Parameter

You can pass the API secret as a query parameter named `token`. The value of this parameter should be the SHA-512 hash of your `API_SECRET`.

**Example:**

```
GET /api/entries?token=<your_api_secret>
```

### 3. API Secret in the Header

You can also provide the API secret in a custom header named `api-secret`. The value of this header should be the SHA-512 hash of your `API_SECRET`.

**Header:**

```
api-secret: <your_api_secret>
```

## Unauthorized Access

If you fail to provide a valid authentication method, the API will respond with a `401 Unauthorized` status code and the following JSON response:

```json
{
  "message": "Unauthorized"
}
```