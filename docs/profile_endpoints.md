# Profile Endpoints

This document provides details about the API endpoints related to user profiles.

## Get All Profiles

-   **Endpoint:** `GET /profiles`
-   **Description:** Retrieves a list of all user profiles.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (optional): A JSON object for filtering results. See [Database Documentation](database.md) for more details on filtering.
    -   `count` (optional): The maximum number of profiles to return.
-   **Responses:**
    -   `200 OK`: A JSON array of profile objects.

## Get Current Profile

-   **Endpoint:** `GET /profile` or `GET /profile/current`
-   **Description:** Retrieves the most recent profile.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: The current profile object.
    -   `404 Not Found`: If no profile is found.

### Example Response

```json
{
    "_id": "64c2f2b8f1a1b2c3d4e5f6a7",
    "defaultProfile": "Default",
    "date": 1690545600000,
    "created_at": "2023-07-28T12:00:00.000000Z",
    "startDate": "2023-07-28T12:00:00.000000Z",
    "store": {
        "timezone": "UTC",
        "dia": "3",
        "carbratio": "10",
        "carbs_hr": "20"
    },
    "extra_data": {}
}
```

## Create a New Profile

-   **Endpoint:** `POST /profile`
-   **Description:** Creates a new user profile.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object representing the new profile. The `_id` field is optional and will be generated if not provided.
-   **Responses:**
    -   `201 Created`: A JSON object with a confirmation message and the ID of the created profile.

### Example Request Body

```json
{
    "defaultProfile": "Default",
    "startDate": "2023-07-28T12:00:00Z",
    "store": {
        "timezone": "UTC",
        "dia": "3",
        "carbratio": "10"
    }
}
```

## Update a Profile

-   **Endpoint:** `PUT /profile`
-   **Description:** Updates an existing user profile.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object with the updated profile data, including the `_id` of the profile to be updated.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message.
    -   `400 Bad Request`: If the `_id` is not specified.
    -   `404 Not Found`: If the profile is not found.

## Delete a Profile

-   **Endpoint:** `DELETE /profile/{id}`
-   **Description:** Deletes a specific user profile by its ID.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **URL Parameters:**
    -   `id` (required): The `_id` of the profile to delete.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the ID of the deleted profile.
    -   `404 Not Found`: If the profile is not found.
