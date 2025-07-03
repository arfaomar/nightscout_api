# Database Schema and Querying

This document outlines the database schema for this Nightscout API reimplementation and explains how to query the database using the provided `QueryHelper`.

## Database Schema

The database schema is defined by Laravel migration files located in `database/migrations`. The following tables are created:

-   **`entries`**: Stores blood glucose readings and related data.
-   **`treatments`**: Records insulin doses, carbohydrate intake, and other treatments.
-   **`device_statuses`**: Contains information about the status of connected devices.
-   **`statuses`**: General status information about the Nightscout instance.
-   **`activities`**: Stores information about physical activities.
-   **`foods`**: Records food intake.
-   **`profiles`**: Manages user profiles and settings.

### Table Details

<details>
<summary>entries</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `created_at` | `timestamp` |   |
| `type` | `string` |   |
| `dateString` | `timestamp` |   |
| `date` | `bigint` |   |
| `sgv` | `float` |   |
| `direction` | `string` |   |
| `noise` | `float` |   |
| `filtered` | `float` |   |
| `unfiltered` | `float` |   |
| `rssi` | `float` |   |
| `extra_data` | `jsonb` |   |

</details>

<details>
<summary>treatments</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `eventType` | `string(255)` |   |
| `created_at` | `timestamp` |   |
| `glucose` | `string(255)` |   |
| `glucoseType` | `string(255)` |   |
| `carbs` | `float` |   |
| `protein` | `float` |   |
| `fat` | `float` |   |
| `insulin` | `float` |   |
| `units` | `string(255)` |   |
| `transmitterId` | `string(255)` |   |
| `sensorCode` | `string(255)` |   |
| `notes` | `text` |   |
| `enteredBy` | `string(255)` |   |
| `extra_data` | `jsonb` |   |

</details>

<details>
<summary>device_statuses</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `device` | `string(255)` |   |
| `created_at` | `timestamp` |   |
| `openaps` | `jsonb` |   |
| `loop` | `jsonb` |   |
| `uploaderBattery` | `integer` |   |
| `isCharging` | `boolean` |   |
| `configuration` | `jsonb` |   |
| `pump` | `jsonb` |   |
| `uploader` | `jsonb` |   |
| `xdripjs` | `jsonb` |   |
| `extra_data` | `jsonb` |   |

</details>

<details>
<summary>statuses</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `apiEnabled` | `boolean` |   |
| `carePortalEnabled` | `boolean` |   |
| `head` | `string(255)` |   |
| `name` | `string(64)` |   |
| `version` | `string(255)` |   |
| `settings` | `jsonb` |   |
| `extended_settings` | `jsonb` |   |
| `extra_data` | `jsonb` |   |

</details>

<details>
<summary>activities</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `eventType` | `string(255)` |   |
| `duration` | `integer` |   |
| `created_at` | `timestamp` |   |
| `notes` | `text` |   |
| `enteredBy` | `string(255)` |   |
| `extra_data` | `jsonb` |   |

</details>

<details>
<summary>foods</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `created_at` | `timestamp` |   |
| `extra_data` | `jsonb` |   |

</details>

<details>
<summary>profiles</summary>

| Column | Type | Description |
| :--- | :--- | :--- |
| `_id` | `string(24)` | **Primary Key** |
| `defaultProfile` | `string` |   |
| `date` | `bigint` |   |
| `created_at` | `timestamp` |   |
| `startDate` | `timestamp` |   |
| `store` | `jsonb` |   |
| `extra_data` | `jsonb` |   |

</details>

## Querying with `QueryHelper`

The `App\Helpers\QueryHelper` class provides a method `applyNightscoutFind` to translate Nightscout-style find queries (similar to MongoDB) into Eloquent queries. This allows for complex filtering on both regular columns and nested data within JSON fields.

### Supported Operators

The `applyNightscoutFind` method supports the following operators:

-   `$eq`: Equal to
-   `$ne`: Not equal to
-   `$gt`: Greater than
-   `$gte`: Greater than or equal to
-   `$lt`: Less than
-   `$lte`: Less than or equal to
-   `$in`: In a list of values
-   `$nin`: Not in a list of values
-   `$regex`: Regular expression match

### How it Works

The `applyNightscoutFind` method dynamically inspects the model's table to distinguish between regular columns and JSON columns.

-   **For regular columns**, it applies the operators directly to the query.
-   **For JSON columns**, it uses `jsonb_path_exists` for most operators and `ILIKE` for `$regex` to search within the JSON structure.

### Example Usage

```php
use App\Models\Entry;
use App\Helpers\QueryHelper;

// Find entries with sgv greater than 180
$find = [
    'sgv' => ['$gt' => 180]
];
$query = Entry::query();
QueryHelper::applyNightscoutFind($query, $find);
$results = $query->get();

// Find treatments with insulin greater than 5 and carbs greater than 50
$find = [
    'insulin' => ['$gt' => 5],
    'carbs' => ['$gt' => 50]
];
$query = Treatment::query();
QueryHelper::applyNightscoutFind($query, $find);
$results = $query->get();
```
