<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryHelper
{
    /**
     * Uses the Nightscout find syntax to apply conditions to a query.
     * Supports operators: $lt, $lte, $gt, $gte, $ne, $eq (default), etc.
     * 
     * @param Builder $query The query builder instance.
     * @param array $find The conditions to apply, structured as an associative array.
     * @return Builder The modified query builder instance.
     */
    public static function applyNightscoutFind(Builder $query, array $find)
{

    static $columns = null;
    if ($columns === null) {
        $columns = \Schema::getColumnListing($query->getModel()->getTable());
    }

    foreach ($find as $field => $condition) {
        $dbField = in_array($field, $columns) ? $field : "extra_data->$field";

        if (is_array($condition)) {
            foreach ($condition as $op => $value) {
                switch ($op) {
                    case '$eq':
                        $query->where($dbField, '=', $value);
                        break;
                    case '$ne':
                        $query->where($dbField, '!=', $value);
                        break;
                    case '$gt':
                        $query->where($dbField, '>', $value);
                        break;
                    case '$gte':
                        $query->where($dbField, '>=', $value);
                        break;
                    case '$lt':
                        $query->where($dbField, '<', $value);
                        break;
                    case '$lte':
                        $query->where($dbField, '<=', $value);
                        break;
                    case '$in':
                        $arr = is_array($value) ? $value : explode('|', $value);
                        $query->whereIn($dbField, $arr);
                        break;
                    case '$nin':
                        $arr = is_array($value) ? $value : explode('|', $value);
                        $query->whereNotIn($dbField, $arr);
                        break;
                    case '$regex':
                        $query->where($dbField, 'like', '%' . $value . '%');
                        break;
                }
            }
        } else {
            $query->where($dbField, $condition);
        }
    }
    return $query;
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
