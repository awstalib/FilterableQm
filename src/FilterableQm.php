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
            //if extendedFilter method is not defined in the model then it will be ignored
            if(method_exists($this,'extendedFilter')){
                $this->extendedFilter($query, $key, $value);
            }

            // Check if the key is allowed and the value is not empty
            if (in_array($key, $this->filterItems) && $value!=null) {
                $query->where($key, $value);
            }
        }

        return $query;
    }
}
