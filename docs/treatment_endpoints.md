# Treatment Endpoints

This document provides details about the API endpoints related to treatments.

## Get All Treatments

-	**Endpoint:** `GET /treatments`
-	**Description:** Retrieves a list of all treatments.
-	**Authentication:** Required (see [Authentication](authentication.md))
-	**Query Parameters:**
-		`find` (optional): A JSON object for filtering results. See [Database Documentation](database.md) for more details on filtering.
-		`count` (optional): The maximum number of treatments to return.
-	**Responses:**
-		`200 OK`: A JSON array of treatment objects.

### Example Request

```bash
curl -X GET "https://your-nightscout-url/api/v1/treatments?find[insulin][$gte]=5&count=10" \
     -H "Authorization: Bearer <your_jwt_token>"
```

### Example Response

```json
[
    {
        "_id": "64c2f2b8f1a1b2c3d4e5f6a7",
        "eventType": "Meal Bolus",
        "created_at": "2023-07-28T12:00:00.000000Z",
        "glucose": "120",
        "glucoseType": "Sensor",
        "carbs": 30,
        "protein": 10,
        "fat": 5,
        "insulin": 5,
        "units": "U",
        "notes": "Lunch",
        "enteredBy": "John Doe",
        "extra_data": {}
    }
]
```

## Get a Specific Treatment

-	**Endpoint:** `GET /treatments/{spec}`
-	**Description:** Retrieves a specific treatment by its ID.
-	**Authentication:** Required (see [Authentication](authentication.md))
-	**URL Parameters:**
-		`spec` (required): The `_id` of the treatment to retrieve.
-	**Responses:**
-		`200 OK`: The specified treatment object.
-		`404 Not Found`: If the treatment is not found.

## Create a New Treatment

-	**Endpoint:** `POST /treatments`
-	**Description:** Creates a new treatment. Can accept a single treatment object or an array of treatment objects.
-	**Authentication:** Required (see [Authentication](authentication.md))
-	**Request Body:** A JSON object or an array of JSON objects representing the new treatment/treatments. The `_id` field is optional and will be generated if not provided.
-	**Responses:**
-		`201 Created`: The newly created treatment object or an array of created treatment objects.

### Example Request Body

```json
{
    "eventType": "Meal Bolus",
    "created_at": "2023-07-28T12:00:00Z",
    "carbs": 30,
    "insulin": 5
}
```

## Update a Treatment

-	**Endpoint:** `PUT /treatments`
-	**Description:** Updates an existing treatment.
-	**Authentication:** Required (see [Authentication](authentication.md))
-	**Request Body:** A JSON object with the updated treatment data, including the `_id` of the treatment to be updated.
-	**Responses:**
-		`200 OK`: The updated treatment object.
-		`400 Bad Request`: If the `_id` is not specified.
-		`404 Not Found`: If the treatment is not found.

## Delete Treatments

-	**Endpoint:** `DELETE /treatments`
-	**Description:** Deletes treatments based on a filter.
-	**Authentication:** Required (see [Authentication](authentication.md))
-	**Query Parameters:**
-		`find` (required): A JSON object for filtering the treatments to be deleted.
-	**Responses:**
-		`200 OK`: A JSON object with a confirmation message and the number of deleted treatments.
-		`404 Not Found`: If no matching treatments are found.

## Delete a Specific Treatment

-	**Endpoint:** `DELETE /treatments/{spec}`
-	**Description:** Deletes a specific treatment by its ID.
-	**Authentication:** Required (see [Authentication](authentication.md))
-	**URL Parameters:**
-		`spec` (required): The `_id` of the treatment to delete.
-	**Responses:**
-		`200 OK`: A JSON object with a confirmation message and the ID of the deleted treatment.
-		`404 Not Found`: If the treatment is not found.
