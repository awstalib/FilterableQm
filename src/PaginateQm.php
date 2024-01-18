<?php

namespace Awstalib\FilterableQm;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait PaginateQm
{
    /**
     * @param Builder $query builder
     * @param Request $request
     * @param int $skipDefault
     * @param int $takeDefault
     * @return stdClass of "data" and "count"
     */
    protected function paginateQuery(Builder $queryBuilder, Request $request, bool $enableFilter = false)
    {
        $skipKey = config('filterable_qm.skip_key');
        $takeKey = config('filterable_qm.take_key');
        $skipDefault = config('filterable_qm.default_skip', 0);
        $takeDefault = config('filterable_qm.default_take', 10);

        $skip = $request->input($skipKey, $skipDefault);
        $take = $request->input($takeKey, $takeDefault);

        if ($enableFilter) {
            // Check if the trait's method is present in the model
            if (!method_exists($queryBuilder->getModel(), 'scopeApplyFilters')) {
                throw new \RuntimeException("The FilterableQm trait must be used in the model.");
            }
            $query = $queryBuilder->applyFilters($request->except(config('filterable_qm.skip_key'), config('filterable_qm.take_key')));
        } else {
            $query = $queryBuilder;
        }
        $count = $query->count();
        $data = $query->skip($skip)->take($take)->get();

        // if ($returnHttp) {
        //     return Apires::success($data, 'Data retrieved successfully', null, $count);
        // }
        $retrunValue = new \stdClass();
        $retrunValue->data = $data;
        $retrunValue->count = $count;
        return $retrunValue;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\Request $request
     * @param bool $returnHttp
     * @param int $skipDefault
     * @param int $takeDefault
     * @return stdClass of "data" and "count"
     */
    protected function paginateModel($model, Request $request)
    {
        $skipKey = config('filterable_qm.skip_key');
        $takeKey = config('filterable_qm.take_key');
        $skipDefault = config('filterable_qm.default_skip', 0);
        $takeDefault = config('filterable_qm.default_take', 10);

        $skip = $request->input($skipKey, $skipDefault);
        $take = $request->input($takeKey, $takeDefault);

        $query = $model->query()->applyFilters($request->except(config('filterable_qm.skip_key'), config('filterable_qm.take_key')));
        $count = $query->count();
        $data = $query->skip($skip)->take($take)->get();

        // if ($returnHttp) {
        //     return Apires::success($data, 'Data retrieved successfully', null, $count);
        // }

        $retrunValue = new \stdClass();
        $retrunValue->data = $data;
        $retrunValue->count = $count;
        return $retrunValue;
    }
}
