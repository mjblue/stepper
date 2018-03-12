<?php

namespace UserFrosting\Sprinkle\Site\Database\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MemberAuxScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $baseTable = $model->getTable();
        // Hardcode the table name here, or you can access it using the classMapper and `getTable`
        $auxTable = 'members';

        // Specify columns to load from base table and aux table
        $builder->addSelect(
            "$baseTable.*",
            "$auxTable.weekly_total_steps as weekly_total_steps",
            "$auxTable.cumulative_total_steps as cumulative_total_steps"
        );

        // Join on matching `member` records
        $builder->leftJoin($auxTable, function ($join) use ($baseTable, $auxTable) {
            $join->on("$auxTable.id", '=', "$baseTable.id");
        });
    }
}