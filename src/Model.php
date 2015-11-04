<?php

namespace Optimus\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * Add the possibility to add multiple where clauses at once to a builder
     * @param  Builder $query
     * @param  array $clauses
     * @return Builder
     */
    public function scopeWhereArray($query, array $clauses)
    {
        foreach ($clauses as $column => $value) {
            $query->where($column, $value);
        }

        return $query;
    }
}
