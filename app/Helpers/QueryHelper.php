<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryHelper
{
    /**
     * Uses the Nightscout find syntax to apply conditions to a query.
     * Supports operators: $lt, $lte, $gt, $gte, $ne, $eq (default), etc.
     */
    public static function applyNightscoutFind(Builder $query, array $find)
    {
        foreach ($find as $field => $condition) {
            if (is_array($condition)) {
                foreach ($condition as $op => $value) {
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
            } else {
                // Normalwert
                $query->where($field, $condition);
            }
        }
        return $query;
    }
}
