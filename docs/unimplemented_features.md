# Unimplemented Features

This document lists features from the original Nightscout API that are not yet implemented in this reimplementation.

## General

- **Websockets:** The original Nightscout API uses websockets for real-time data updates. This uses socket.IO which is
  not implemented in PHP. Real-time communication (RTC) is handled via a Node.js socket.io bridge that intercepts
  connections from Android APS and relays them to our REST API.
- **Reports:** The reporting functionality of the original API is not yet implemented. This project is focused solely on
  implementing the API and a database solution, not on plugins.
- **Pebble Integration:** The Pebble watch integration is not implemented.

## API Endpoints

Based on a review of the `routes/api.php` file and comparison with the original Nightscout API Swagger documentation,
the following API endpoints and features are not yet implemented:

- **v2 API:** The v2 API is not implemented, except for the authorization request endpoints.
- **Complex `entries` filtering:** Endpoints like `GET /slice/{storage}/{field}/{type}/{prefix}/{regex}`, and
  `GET /times/{prefix}/{regex}` are not implemented. The current `/entries` endpoint only supports basic filtering via
  the `find` query parameter.
- **Debugging Endpoints:** Endpoints like `GET /echo/{storage}/{spec}` and `GET /times/echo/{prefix}/{regex}` are not
  implemented.
- **Specific `treatments` endpoints:** `GET /treatments/cal.json` is not implemented.
- **Specific `devicestatus` endpoints:** `GET /devicestatus/history` is not implemented.
- **Full Notification System:** While some notification endpoints exist, the full notification system (beyond basic
  Pushover callbacks and acknowledgements) is not yet implemented.

## Hardcoded Responses

Some API endpoints currently return hardcoded or default values, rather than dynamically retrieving all information from
the database or performing full logic. These include:

- **`GET /adminnotifies`**: Returns a hardcoded `notifyCount` and an empty `notifies` array.
- **`POST /alexa`**: The `GetGlucoseIntent` returns a hardcoded glucose value.
- **`POST /googlehome`**: Returns hardcoded responses for `GetInsulinIntent` and `DefaultIntent`.
- **`GET /notifications/ack`**: Returns a simple `OK` status without performing any specific acknowledgement logic.
- **`GET /status`**: Returns hardcoded default values for various status fields if no status record is found in the
  database.
- **`GET /test` (Experiments API)**: Always returns a hardcoded `status: 'ok'`.
- **`GET /versions`**: Returns a hardcoded list of API versions, indicating support for v1, v2, and v3, even though this
  implementation only fully supports v1.
- **`GET /verifyauth`**: Returns hardcoded `canRead`, `canWrite`, `isAdmin`, `message`, `rolefound`, and `permissions`
  based on the authentication method, rather than dynamic role-based permissions. This is a simplified implementation of
  the original Nightscout authorization.
