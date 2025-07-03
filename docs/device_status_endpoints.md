# Device Status Endpoints

This document provides details about the API endpoints related to device status.

## Get All Device Statuses

-   **Endpoint:** `GET /devicestatus`
-   **Description:** Retrieves a list of all device statuses.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (optional): A JSON object for filtering results. See [Database Documentation](database.md) for more details on filtering.
    -   `count` (optional): The maximum number of device statuses to return.
-   **Responses:**
    -   `200 OK`: A JSON array of device status objects.

### Example Response

```json
[
    {
        "_id": "64c2f2b8f1a1b2c3d4e5f6a7",
        "device": "pump-loop",
        "created_at": "2023-07-28T12:00:00.000000Z",
        "pump": {
            "clock": "2023-07-28T12:00:00.000Z",
            "reservoir": 150.5,
            "status": "normal"
        },
        "uploaderBattery": 80,
        "extra_data": {}
    }
]
```

## Create a New Device Status

-   **Endpoint:** `POST /devicestatus`
-   **Description:** Creates a new device status.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object representing the new device status. The `_id` field is optional and will be generated if not provided.
-   **Responses:**
    -   `201 Created`: A JSON object with a confirmation message and the ID of the created device status.

### Example Request Body

```json
{
    "device": "pump-loop",
    "created_at": "2023-07-28T12:00:00Z",
    "pump": {
        "clock": "2023-07-28T12:00:00.000Z",
        "reservoir": 150.5
    },
    "uploaderBattery": 80
}
```

## Delete Device Statuses

-   **Endpoint:** `DELETE /devicestatus`
-   **Description:** Deletes device statuses based on a filter.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (required): A JSON object for filtering the device statuses to be deleted.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the number of deleted device statuses.
    -   `404 Not Found`: If no matching device statuses are found.

## Delete a Specific Device Status

-   **Endpoint:** `DELETE /devicestatus/{spec}`
-   **Description:** Deletes a specific device status by its ID.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **URL Parameters:**
    -   `spec` (required): The `_id` of the device status to delete.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the ID of the deleted device status.
    -   `404 Not Found`: If the device status is not found.
