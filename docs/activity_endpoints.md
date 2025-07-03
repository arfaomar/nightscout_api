# Activity Endpoints

This document provides details about the API endpoints related to activities.

## Get All Activities

-   **Endpoint:** `GET /activity`
-   **Description:** Retrieves a list of all activities.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (optional): A JSON object for filtering results. See [Database Documentation](database.md) for more details on filtering.
    -   `count` (optional): The maximum number of activities to return.
-   **Responses:**
    -   `200 OK`: A JSON array of activity objects.

### Example Response

```json
[
    {
        "_id": "64c2f2b8f1a1b2c3d4e5f6a7",
        "eventType": "Exercise",
        "duration": 30,
        "created_at": "2023-07-28T12:00:00.000000Z",
        "notes": "Morning run",
        "enteredBy": "John Doe",
        "extra_data": {}
    }
]
```

## Create a New Activity

-   **Endpoint:** `POST /activity`
-   **Description:** Creates a new activity. Can accept a single activity object or an array of activity objects.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object or an array of JSON objects representing the new activity/activities. The `_id` field is optional and will be generated if not provided.
-   **Responses:**
    -   `201 Created`: The newly created activity object or an array of created activity objects.

### Example Request Body

```json
{
    "eventType": "Exercise",
    "duration": 30,
    "created_at": "2023-07-28T12:00:00Z",
    "notes": "Morning run"
}
```

## Update an Activity

-   **Endpoint:** `PUT /activity`
-   **Description:** Updates an existing activity.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object with the updated activity data, including the `_id` of the activity to be updated.
-   **Responses:**
    -   `200 OK`: The updated activity object.
    -   `400 Bad Request`: If the `_id` is not specified.
    -   `404 Not Found`: If the activity is not found.

## Delete an Activity

-   **Endpoint:** `DELETE /activity/{id}`
-   **Description:** Deletes a specific activity by its ID.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **URL Parameters:**
    -   `id` (required): The `_id` of the activity to delete.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the ID of the deleted activity.
    -   `404 Not Found`: If the activity is not found.
