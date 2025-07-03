# Entry Endpoints

This document provides details about the API endpoints related to entries.

## Get All Entries

-   **Endpoint:** `GET /entries`
-   **Description:** Retrieves a list of all entries.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (optional): A JSON object for filtering results. See [Database Documentation](database.md) for more details on filtering.
    -   `count` (optional): The maximum number of entries to return.
-   **Responses:**
    -   `200 OK`: A JSON array of entry objects.

### Example Request

```bash
curl -X GET "https://your-nightscout-url/api/v1/entries?find[sgv][$gt]=180&count=10" 
     -H "Authorization: Bearer <your_jwt_token>"
```

### Example Response

```json
[
    {
        "_id": "64c2f2b8f1a1b2c3d4e5f6a7",
        "created_at": "2023-07-28T12:00:00.000000Z",
        "type": "sgv",
        "dateString": "2023-07-28 12:00:00",
        "date": 1690545600000,
        "sgv": 185,
        "direction": "Flat",
        "noise": 1,
        "filtered": 185,
        "unfiltered": 186,
        "rssi": 100,
        "extra_data": {}
    }
]
```

## Get Current Entry

-   **Endpoint:** `GET /entries/current`
-   **Description:** Retrieves the most recent entry.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: The current entry object.
    -   `404 Not Found`: If no entries are found.

## Get a Specific Entry

-   **Endpoint:** `GET /entries/{spec}`
-   **Description:** Retrieves a specific entry by its ID.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **URL Parameters:**
    -   `spec` (required): The `_id` of the entry to retrieve.
-   **Responses:**
    -   `200 OK`: The specified entry object.
    -   `404 Not Found`: If the entry is not found.

## Create a New Entry

-   **Endpoint:** `POST /entries`
-   **Description:** Creates a new entry. Can accept a single entry object or an array of entry objects.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object or an array of JSON objects representing the new entry/entries. The `_id` field is optional and will be generated if not provided.
-   **Responses:**
    -   `201 Created`: A JSON object with a confirmation message and the ID of the created entry.

### Example Request Body

```json
{
    "type": "sgv",
    "dateString": "2023-07-28T12:00:00Z",
    "date": 1690545600000,
    "sgv": 185
}
```

## Preview an Entry

-   **Endpoint:** `POST /entries/preview`
-   **Description:** Validates and returns a preview of an entry without saving it.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object representing the entry to preview.
-   **Responses:**
    -   `200 OK`: A JSON object with a validation message and the validated entry data.

## Delete Entries

-   **Endpoint:** `DELETE /entries`
-   **Description:** Deletes entries based on a filter.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (required): A JSON object for filtering the entries to be deleted.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the number of deleted entries.
    -   `404 Not Found`: If no matching entries are found.

## Delete a Specific Entry

-   **Endpoint:** `DELETE /entries/{spec}`
-   **Description:** Deletes a specific entry by its ID.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **URL Parameters:**
    -   `spec` (required): The `_id` of the entry to delete.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the ID of the deleted entry.
    -   `404 Not Found`: If the entry is not found.
