# Authentication

This document describes the authentication methods for accessing the API endpoints.

## Environment Variables

For authentication to work correctly, you must set the following environment variables in your `.env` file:

-   `API_SECRET`: A secret key used for direct API authentication.
-   `JWT_SECRET`: A secret key used for signing JSON Web Tokens (JWT).

## Authentication Flow

The recommended authentication flow is to use a JWT. To obtain a JWT, you need to make a request to the authorization endpoint with your `API_SECRET`.

1.  **Request a Token:** Make a GET request to `/api/v2/authorization/request/{apiSecret}` or `/api/v2/authorization/request/token={apiSecret}`, replacing `{apiSecret}` with your `API_SECRET`.
2.  **Receive the Token:** The server will respond with a JSON object containing your JWT.
3.  **Authenticate:** Use the received JWT as a Bearer token in the `Authorization` header of your subsequent requests.

## Authentication Methods

The API supports three methods of authentication. You can use any of the following methods to authenticate your
requests.

### 1. Bearer Token (JWT)

You can authenticate by providing a JSON Web Token (JWT) in the `Authorization` header of your request.
You can obtain this token by following the authorization flow described in
the [Authorization Endpoints](authorization_endpoints.md).

![JWT](./illustrations/jwt_auth_flow.png)

**Header:**

```
Authorization: Bearer <your_jwt_token>
```

The JWT should be signed with the `HS512` algorithm using the `JWT_SECRET` configured in the application's environment.

### 2. API Secret as a Query Parameter

You can pass the API secret as a query parameter named `token`. The value of this parameter should be your `API_SECRET`.

![Query Param](./illustrations/query_parameter_auth_flow.png)

**Example:**

```
GET /api/entries?token=<your_api_secret>
```

### 3. API Secret in the Header

You can also provide the API secret in a custom header named `api-secret`. The value of this header should be your
`API_SECRET`.

![header](./illustrations/header_auth_flow.png)

**Header:**

```
api-secret: <your_api_secret>
```

## Unauthorized Access

If you fail to provide a valid authentication method, the API will respond with a `401 Unauthorized` status code and the
following JSON response:

```json
{
    "message": "Unauthorized"
}
```
