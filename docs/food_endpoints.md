# Food Endpoints

This document provides details about the API endpoints related to food.

## Get All Food Items

- **Endpoint:** `GET /food`
- **Description:** Retrieves a list of all food items.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of food objects.

## Get Quick Pick Food Items

- **Endpoint:** `GET /food/quickpicks`
- **Description:** Retrieves a list of quick pick food items.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of quick pick food objects.

## Get Regular Food Items

- **Endpoint:** `GET /food/regular`
- **Description:** Retrieves a list of regular food items.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of regular food objects.

## Create a New Food Item

- **Endpoint:** `POST /food`
- **Description:** Creates a new food item.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the new food item.
- **Responses:**
  - `201 Created`: The newly created food object.

## Update a Food Item

- **Endpoint:** `PUT /food`
- **Description:** Updates an existing food item.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object with the updated food data.
- **Responses:**
  - `200 OK`: The updated food object.

## Delete a Food Item

- **Endpoint:** `DELETE /food/{id}`
- **Description:** Deletes a specific food item by its ID.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `id` (required): The ID of the food item to delete.
- **Responses:**
  - `204 No Content`: The food item was successfully deleted.