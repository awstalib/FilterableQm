<?php

namespace Awstalib\FilterableQm;

trait FilterableQm
{
    /**
     * Apply filters to the query based on the provided filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApplyFilters($query, $filters)
    {
        // Loop through filters and apply each one to the query
        foreach ($filters as $key => $value) {
            // Extendable filter method if needed
            $this?->extendedFilter($query, $key, $value);

            // Check if the key is allowed and the value is not empty
            if (in_array($key, $this->filterItems) && !empty($value)) {
                $query->where($key, $value);
            }
        }

        return $query;
    }
}
