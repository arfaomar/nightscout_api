# Profile Endpoints

This document provides details about the API endpoints related to user profiles.

## Get All Profiles

- **Endpoint:** `GET /profiles`
- **Description:** Retrieves a list of all user profiles.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of profile objects.

## Get a Specific Profile

- **Endpoint:** `GET /profile`
- **Description:** Retrieves the current user's profile.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: The current user's profile object.

## Get the Current Profile

- **Endpoint:** `GET /profile/current`
- **Description:** Retrieves the current user's profile.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: The current user's profile object.

## Create a New Profile

- **Endpoint:** `POST /profile`
- **Description:** Creates a new user profile.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the new profile.
- **Responses:**
  - `201 Created`: The newly created profile object.

## Update a Profile

- **Endpoint:** `PUT /profile`
- **Description:** Updates the current user's profile.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object with the updated profile data.
- **Responses:**
  - `200 OK`: The updated profile object.

## Delete a Profile

- **Endpoint:** `DELETE /profile/{id}`
- **Description:** Deletes a specific user profile by its ID.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `id` (required): The ID of the profile to delete.
- **Responses:**
  - `204 No Content`: The profile was successfully deleted.