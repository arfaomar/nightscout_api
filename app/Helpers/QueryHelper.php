<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class QueryHelper
{
    /**
     * Applies Nightscout-style "find" conditions to an Eloquent query builder.
     *
     * Supports MongoDB-like operators ($lt, $lte, $gt, $gte, $ne, $eq, $in, $nin, $regex)
     * on both SQL columns and on nested fields stored in a JSON/JSONB column.
     *
     * @param Builder $query The query builder instance.
     * @param array $find The find conditions as an associative array.
     * @return Builder The modified query builder.
     */
    public static function applyNightscoutFind(Builder $query, array $find)
    {
        static $columns = null;
        static $jsonFields = null;
        $table = $query->getModel()->getTable();

        // Get all column names once
        if ($columns === null) {
            $columns = Schema::getColumnListing($query->getModel()->getTable());
        }

        // Detect JSON/JSONB columns once
        if ($jsonFields === null) {
            $jsonFields = [];
            foreach ($columns as $col) {
                $type = Schema::getColumnType($table, $col);
                if ($type === 'json' || $type === 'jsonb') {
                    $jsonFields[] = $col;
                }
            }
        }
        foreach ($find as $field => $condition) {
            // If nested JSON path, process recursively (only for extra_data by default)
            if (is_array($condition) && self::isAssoc($condition) && !self::containsOperator($condition)) {
                $jsonPath = 'extra_data';
                $sub = $condition;
                $jsonParts = [$field];
                while (is_array($sub) && count($sub) == 1 && !self::containsOperator($sub)) {
                    $next = array_key_first($sub);
                    $jsonParts[] = $next;
                    $sub = $sub[$next];
                }
                $jsonPath .= '->' . implode('->', $jsonParts);
                // If at the end of the path operators are used, apply them
                if (is_array($sub)) {
                    foreach ($sub as $op => $value) {
                        self::applyOp($query, $jsonPath, $op, $value);
                    }
                } else {
                    $query->where($jsonPath, $sub);
                }

                continue;
            }

            // If the field is a regular SQL column
            if (in_array($field, $columns)) {
                if (is_array($condition)) {
                    foreach ($condition as $op => $value) {
                        self::applyOp($query, $field, $op, $value);
                    }
                } else {
                    $query->where($field, $condition);
                }

                continue;
            }

            // Search in all JSON fields (e.g., extra_data, pump, uploader, ...)
            foreach ($jsonFields as $jsonField) {
                if (is_array($condition)) {
                    foreach ($condition as $op => $value) {
                        $escapedField = addslashes($field);
                        $stringValue = '"' . addslashes($value) . '"';
                        switch ($op) {
                            case '$eq':
                                $jsonpathString = '$.**."' . $escapedField . '" ? (@ == ' . $stringValue . ')';
                                $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathString')");
                                if (is_numeric($value)) {
                                    $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ == ' . $value . ')';
                                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                                }
                                break;

                            case '$ne':
                                $jsonpathString = '$.**."' . $escapedField . '" ? (@ != ' . $stringValue . ')';
                                $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathString')");
                                if (is_numeric($value)) {
                                    $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ != ' . $value . ')';
                                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                                }
                                break;

                            case '$gt':
                                if (is_numeric($value)) {
                                    $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ > ' . $value . ')';
                                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                                }
                                break;

                            case '$gte':
                                if (is_numeric($value)) {
                                    $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ >= ' . $value . ')';
                                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                                }
                                break;

                            case '$lt':
                                if (is_numeric($value)) {
                                    $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ < ' . $value . ')';
                                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                                }
                                break;

                            case '$lte':
                                if (is_numeric($value)) {
                                    $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ <= ' . $value . ')';
                                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                                }
                                break;
                            case '$in':
                                // Match any value in the list
                                if (!is_array($value)) {
                                    $value = explode('|', $value);
                                }
                                $orParts = [];
                                foreach ($value as $v) {
                                    $orParts[] = '(@ == "' . addslashes($v) . '")';
                                    if (is_numeric($v)) {
                                        $orParts[] = '(@ == ' . $v . ')';
                                    }
                                }
                                $jsonpath = '$.**."' . $escapedField . '" ? (' . implode(' || ', $orParts) . ')';
                                $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpath')");
                                break;
                            case '$nin':
                                // Exclude all values in the list
                                if (!is_array($value)) {
                                    $value = explode('|', $value);
                                }
                                $andParts = [];
                                foreach ($value as $v) {
                                    $andParts[] = '(@ != "' . addslashes($v) . '")';
                                    if (is_numeric($v)) {
                                        $andParts[] = '(@ != ' . $v . ')';
                                    }
                                }
                                $jsonpath = '$.**."' . $escapedField . '" ? (' . implode(' && ', $andParts) . ')';
                                $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpath')");
                                break;
                            case '$regex':
                                // Case-insensitive substring match
                                $query->orWhere("$jsonField::text", 'ILIKE', '%"' . $escapedField . '":"%' . addslashes($value) . '%"');
                                break;

                            default:
                                break;
                        }
                    }
                } else {
                    // No operator: $eq as string and, if possible, as numeric
                    $escapedField = addslashes($field);
                    $stringValue = '"' . addslashes($condition) . '"';
                    $jsonpathString = '$.**."' . $escapedField . '" ? (@ == ' . $stringValue . ')';
                    $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathString')");
                    if (is_numeric($condition)) {
                        $jsonpathNumeric = '$.**."' . $escapedField . '" ? (@ == ' . $condition . ')';
                        $query->orWhereRaw("jsonb_path_exists($jsonField, '$jsonpathNumeric')");
                    }
                }
            }
        }

        return $query;
    }

    /**
     * Checks if the array is associative (not sequential).
     *
     * @param array $arr The array to check.
     * @return bool True if the array is associative, false if it is sequential.
     */
    public static function isAssoc(array $arr)
    {
        if ($arr === []) {
            return false;
        }

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * Checks if the array contains any MongoDB-like operator keys (starting with '$').
     *
     * @param array $arr The array to check.
     * @return bool True if any key starts with '$', false otherwise.
     */
    public static function containsOperator(array $arr)
    {
        return count(array_filter(array_keys($arr), function ($k) {
                return strpos($k, '$') === 0;
            })) > 0;
    }

    /**
     * Applies a single operator condition to the query.
     *
     * @param Builder $query The query builder instance.
     * @param string $field The field to apply the condition on.
     * @param string $op The operator (e.g., '$eq', '$ne', '$gt', etc.).
     * @param mixed $value The value to compare against.
     */
    public static function applyOp($query, $field, $op, $value)
    {
        switch ($op) {
            case '$eq':
                $query->where($field, '=', $value);
                break;
            case '$ne':
                $query->where($field, '!=', $value);
                break;
            case '$gt':
                $query->where($field, '>', $value);
                break;
            case '$gte':
                $query->where($field, '>=', $value);
                break;
            case '$lt':
                $query->where($field, '<', $value);
                break;
            case '$lte':
                $query->where($field, '<=', $value);
                break;
            case '$in':
                $arr = is_array($value) ? $value : explode('|', $value);
                $query->whereIn($field, $arr);
                break;
            case '$nin':
                $arr = is_array($value) ? $value : explode('|', $value);
                $query->whereNotIn($field, $arr);
                break;
            case '$regex':
                $query->where($field, 'like', '%' . $value . '%');
                break;
        }
    }

    /**
     * Applies a count limit to the query, ordering by created_at in descending order.
     *
     * @param Builder $query The query builder instance.
     * @param int|null $count The maximum number of records to return.
     */
    public static function applyCount(Builder $query, $count = null)
    {
        $query->orderByDesc('created_at');
        if ($count && is_numeric($count)) {
            $query->limit((int)$count);
        }
    }
}
