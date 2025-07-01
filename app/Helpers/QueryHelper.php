<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class QueryHelper
{
    /**
     * Applies Nightscout-style "find" conditions to an Eloquent query builder.
     * 
     * Supports MongoDB-like operators ($lt, $lte, $gt, $gte, $ne, $eq, $in, $nin, $regex) on both
     * SQL columns and on nested fields stored in a JSON/JSONB "extra_data" column.
     * 
     * @param Builder $query The query builder instance.
     * @param array $find The find conditions as an associative array.
     * @return Builder The modified query builder.
     */
    public static function applyNightscoutFind(Builder $query, array $find)
    {
        static $columns = null;
        if ($columns === null) {
            $columns = Schema::getColumnListing($query->getModel()->getTable());
        }
        foreach ($find as $field => $condition) {
            // If nested JSON path, process recursively
            // Creates a JSON path like "extra_data->field1->field2->field3"
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
                // if at the end of the path operators are used, apply them
                if (is_array($sub)) {
                    foreach ($sub as $op => $value) {
                        self::applyOp($query, $jsonPath, $op, $value);
                    }
                } else {
                    $query->where($jsonPath, $sub);
                }
            } else {
                // If the field is a regular column 
                if (in_array($field, $columns)) {
                    if (is_array($condition)) {
                        foreach ($condition as $op => $value) {
                            self::applyOp($query, $field, $op, $value);
                        }
                    } else {
                        $query->where($field, $condition);
                    }
                } else {
                    // Handle JSON/JSONB fields for operators
                    // if the field is not a regular column, assume it's in extra_data
                    if (is_array($condition)) {
                        foreach ($condition as $op => $value) {
                            $escapedField = addslashes($field);
                            $isNumeric = is_numeric($value);
                            $escapedValue = $isNumeric ? $value : '"' . addslashes($value) . '"';
                            // Handle MongoDB-like operators
                            switch ($op) {
                                case '$eq':
                                    $jsonpath = '$.**."' . $escapedField . '" ? (@ == ' . $escapedValue . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$ne':
                                    $jsonpath = '$.**."' . $escapedField . '" ? (@ != ' . $escapedValue . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$gt':
                                    $jsonpath = '$.**."' . $escapedField . '" ? (@ > ' . $escapedValue . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$gte':
                                    $jsonpath = '$.**."' . $escapedField . '" ? (@ >= ' . $escapedValue . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$lt':
                                    $jsonpath = '$.**."' . $escapedField . '" ? (@ < ' . $escapedValue . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$lte':
                                    $jsonpath = '$.**."' . $escapedField . '" ? (@ <= ' . $escapedValue . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$in':
                                    if (!is_array($value)) {
                                        $value = explode('|', $value);
                                    }
                                    $orParts = [];
                                    foreach ($value as $v) {
                                        $ev = is_numeric($v) ? $v : '"' . addslashes($v) . '"';
                                        $orParts[] = '(@ == ' . $ev . ')';
                                    }
                                    $jsonpath = '$.**."' . $escapedField . '" ? (' . implode(' || ', $orParts) . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$nin':
                                    if (!is_array($value)) {
                                        $value = explode('|', $value);
                                    }
                                    $andParts = [];
                                    foreach ($value as $v) {
                                        $ev = is_numeric($v) ? $v : '"' . addslashes($v) . '"';
                                        $andParts[] = '(@ != ' . $ev . ')';
                                    }
                                    $jsonpath = '$.**."' . $escapedField . '" ? (' . implode(' && ', $andParts) . ')';
                                    $query->orWhereRaw("jsonb_path_exists(extra_data, '$jsonpath')");
                                    break;

                                case '$regex':
                                    $query->orWhere('extra_data::text', 'ILIKE', '%"' . $escapedField . '":"%' . addslashes($value) . '%"');
                                    break;

                                default:
                                    break;
                            }
                        }
                    } else {
                         // If not an array, just check for equality
                        $query->orWhereRaw(
                            "jsonb_path_exists(extra_data, '$.**.\"$field\" ? (@ == :find_val)')",
                            ['find_val' => $condition]
                        );
                    }
                }
            }
        }
        return $query;
    }
    /**
     * Checks if an array is associative (not a list).
     * 
     * @param array $arr
     * @return bool
     */
    public static function isAssoc(array $arr)
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * Checks if an associative array contains at least one key starting with '$'
     * (meaning, it's using an operator syntax).
     * 
     * @param array $arr
     * @return bool
     */
    public static function containsOperator(array $arr)
    {
        return count(array_filter(array_keys($arr), function ($k) {
            return strpos($k, '$') === 0;
        })) > 0;
    }
    /**
     * Applies a single operator ($eq, $ne, $gt, $gte, $lt, $lte, $in, $nin, $regex)
     * to the Eloquent query builder for the given field.
     * 
     * @param Builder $query
     * @param string $field
     * @param string $op
     * @param mixed $value
     * @return void
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
     * Applies a count limit to the query, ordering by created_at descending.
     * If $count is provided and is numeric, it limits the results to that count.
     *  
     *  
     * @param Builder $query The query builder instance.
     * @param int|null $count The maximum number of results to return.
     * @return void
     * */
    public static function applyCount(Builder $query, $count = null)
    {
        $query->orderByDesc('created_at');
        if ($count && is_numeric($count)) {
            $query->limit((int)$count);
        }
    }
}
