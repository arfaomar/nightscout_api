# Alexa Endpoints

This document provides details about the API endpoints related to Alexa integration.

## Handle Alexa Requests

-   **Endpoint:** `POST /alexa`
-   **Description:** Handles requests from Amazon Alexa. Currently, it only supports the `GetGlucoseIntent`.
-   **Authentication:** Required (see [Authentication](authentication.md))
-   **Request Body:** The request body sent by the Alexa service.
-   **Responses:**
    -   The response format is specific to the Alexa Skills Kit.

### Example `GetGlucoseIntent` Request

```json
{
    "version": "1.0",
    "session": {},
    "request": {
        "type": "IntentRequest",
        "intent": {
            "name": "GetGlucoseIntent"
        }
    }
}
```

### Example Response

```json
{
    "version": "1.0",
    "response": {
        "outputSpeech": {
            "type": "PlainText",
            "text": "Your current glucose is 140 milligrams per deciliter."
        },
        "shouldEndSession": true
    }
}
```
