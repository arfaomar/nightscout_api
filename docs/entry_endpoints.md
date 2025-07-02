# Entry Endpoints

This document provides details about the API endpoints related to entries.

## Get All Entries

- **Endpoint:** `GET /entries`
- **Description:** Retrieves a list of all entries.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of entry objects.

## Get Current Entry

- **Endpoint:** `GET /entries/current`
- **Description:** Retrieves the current entry.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: The current entry object.

## Get a Specific Entry

- **Endpoint:** `GET /entries/{spec}`
- **Description:** Retrieves a specific entry.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `spec` (required): The specification of the entry to retrieve.
- **Responses:**
  - `200 OK`: The specified entry object.

## Create a New Entry

- **Endpoint:** `POST /entries`
- **Description:** Creates a new entry.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the new entry.
- **Responses:**
  - `201 Created`: The newly created entry object.

## Preview an Entry

- **Endpoint:** `POST /entries/preview`
- **Description:** Generates a preview of an entry.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the entry to preview.
- **Responses:**
  - `200 OK`: The entry preview object.

## Delete a Specific Entry

- **Endpoint:** `DELETE /entries/{spec}`
- **Description:** Deletes a specific entry.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `spec` (required): The specification of the entry to delete.
- **Responses:**
  - `204 No Content`: The entry was successfully deleted.

## Delete All Entries

- **Endpoint:** `DELETE /entries`
- **Description:** Deletes all entries.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `204 No Content`: The entries were successfully deleted.