# Device Status Endpoints

This document provides details about the API endpoints related to device status.

## Get All Device Statuses

- **Endpoint:** `GET /devicestatus`
- **Description:** Retrieves a list of all device statuses.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `200 OK`: A JSON array of device status objects.

## Create a New Device Status

- **Endpoint:** `POST /devicestatus`
- **Description:** Creates a new device status.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Request Body:** A JSON object representing the new device status.
- **Responses:**
  - `201 Created`: The newly created device status object.

## Delete All Device Statuses

- **Endpoint:** `DELETE /devicestatus`
- **Description:** Deletes all device statuses.
- **Authentication:** Required (see [Authentication](authentication.md))
- **Responses:**
  - `204 No Content`: The device statuses were successfully deleted.

## Delete a Specific Device Status

- **Endpoint:** `DELETE /devicestatus/{spec}`
- **Description:** Deletes a specific device status.
- **Authentication:** Required (see [Authentication](authentication.md))
- **URL Parameters:**
  - `spec` (required): The specification of the device status to delete.
- **Responses:**
  - `204 No Content`: The device status was successfully deleted.