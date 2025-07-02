# Activity Endpoints

This document provides details about the API endpoints related to activities.

## Get All Activities

- **Endpoint:** `GET /activity`
- **Description:** Retrieves a list of all activities.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of activity objects.

## Create a New Activity

- **Endpoint:** `POST /activity`
- **Description:** Creates a new activity.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the new activity.
- **Responses:**
  - `201 Created`: The newly created activity object.

## Update an Activity

- **Endpoint:** `PUT /activity`
- **Description:** Updates an existing activity.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object with the updated activity data.
- **Responses:**
  - `200 OK`: The updated activity object.

## Delete an Activity

- **Endpoint:** `DELETE /activity/{id}`
- **Description:** Deletes a specific activity by its ID.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `id` (required): The ID of the activity to delete.
- **Responses:**
  - `204 No Content`: The activity was successfully deleted.