# Food Endpoints

This document provides details about the API endpoints related to food.

## Get All Food Items

-   **Endpoint:** `GET /food`
-   **Description:** Retrieves a list of all food items.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Query Parameters:**
    -   `find` (optional): A JSON object for filtering results. See [Database Documentation](database.md) for more details on filtering.
    -   `count` (optional): The maximum number of food items to return.
-   **Responses:**
    -   `200 OK`: A JSON array of food objects.

### Example Response

```json
[
    {
        "_id": "64c2f2b8f1a1b2c3d4e5f6a7",
        "created_at": "2023-07-28T12:00:00.000000Z",
        "extra_data": {
            "name": "Apple",
            "carbs": 25,
            "category": "regular"
        }
    }
]
```

## Get Quick Pick Food Items

-   **Endpoint:** `GET /food/quickpicks`
-   **Description:** Retrieves a list of food items categorized as 'quickpick'.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: A JSON array of quick pick food objects.

## Get Regular Food Items

-   **Endpoint:** `GET /food/regular`
-   **Description:** Retrieves a list of food items categorized as 'regular'.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Responses:**
    -   `200 OK`: A JSON array of regular food objects.

## Create a New Food Item

-   **Endpoint:** `POST /food`
-   **Description:** Creates a new food item.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object representing the new food item. The `_id` field is optional and will be generated if not provided.
-   **Responses:**
    -   `201 Created`: The newly created food object.

### Example Request Body

```json
{
    "name": "Apple",
    "carbs": 25,
    "category": "regular"
}
```

## Update a Food Item

-   **Endpoint:** `PUT /food`
-   **Description:** Updates an existing food item.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** A JSON object with the updated food data, including the `_id` of the food item to be updated.
-   **Responses:**
    -   `200 OK`: The updated food object.
    -   `400 Bad Request`: If the `_id` is not specified.
    -   `404 Not Found`: If the food item is not found.

## Delete a Food Item

-   **Endpoint:** `DELETE /food/{id}`
-   **Description:** Deletes a specific food item by its ID.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **URL Parameters:**
    -   `id` (required): The `_id` of the food item to delete.
-   **Responses:**
    -   `200 OK`: A JSON object with a confirmation message and the ID of the deleted food item.
    -   `404 Not Found`: If the food item is not found.
