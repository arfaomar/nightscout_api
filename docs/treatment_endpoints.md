# Treatment Endpoints

This document provides details about the API endpoints related to treatments.

## Get All Treatments

- **Endpoint:** `GET /treatments`
- **Description:** Retrieves a list of all treatments.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of treatment objects.

## Get a Specific Treatment

- **Endpoint:** `GET /treatments/{spec}`
- **Description:** Retrieves a specific treatment.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `spec` (required): The specification of the treatment to retrieve.
- **Responses:**
  - `200 OK`: The specified treatment object.

## Create a New Treatment

- **Endpoint:** `POST /treatments`
- **Description:** Creates a new treatment.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the new treatment.
- **Responses:**
  - `201 Created`: The newly created treatment object.

## Update a Treatment

- **Endpoint:** `PUT /treatments`
- **Description:** Updates an existing treatment.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object with the updated treatment data.
- **Responses:**
  - `200 OK`: The updated treatment object.

## Delete All Treatments

- **Endpoint:** `DELETE /treatments`
- **Description:** Deletes all treatments.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `204 No Content`: The treatments were successfully deleted.

## Delete a Specific Treatment

- **Endpoint:** `DELETE /treatments/{spec}`
- **Description:** Deletes a specific treatment.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `spec` (required): The specification of the treatment to delete.
- **Responses:**
  - `204 No Content`: The treatment was successfully deleted.