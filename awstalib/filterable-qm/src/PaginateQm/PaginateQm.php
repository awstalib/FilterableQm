<?php

namespace Awstalib\FilterableQm\PaginateQm;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Awstalib\FilterableQM\ApiResponse;

trait PaginateQm
{
    /**
     * @param Builder $query builder
     * @param Request $request
     * @param int $skipDefault
     * @param int $takeDefault
     * @return array
     */
    protected function paginateQuery(Builder $queryBuilder, Request $request, $returnHttp = false, $skipDefault = SkipTake::SKIP, $takeDefault = SkipTake::TAKE)
    {
        $skip = $request->input(config('filterable_qm.skip_key'), $skipDefault);
        $take = $request->input(config('filterable_qm.take_key'), $takeDefault);

        $query = $queryBuilder->applyFilters($request->except(config('filterable_qm.skip_key'), config('filterable_qm.take_key')));
        $count = $query->count();
        $data = $query->skip($skip)->take($take)->get();

        // if ($returnHttp) {
        //     return Apires::success($data, 'Data retrieved successfully', null, $count);
        // }

        return [
            'data' => $data,
            'count' => $count
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\Request $request
     * @param bool $returnHttp
     * @param int $skipDefault
     * @param int $takeDefault
     * @return array
     */
    protected function paginateModel($model, Request $request, $returnHttp = false, $skipDefault = SkipTake::SKIP, $takeDefault = SkipTake::TAKE)
    {
        $skip = $request->input(config('filterable_qm.skip_key'), $skipDefault);
        $take = $request->input(config('filterable_qm.take_key'), $takeDefault);

        $query = $model->query()->applyFilters($request->except(config('filterable_qm.skip_key'), config('filterable_qm.take_key')));
        $count = $query->count();
        $data = $query->skip($skip)->take($take)->get();

        // if ($returnHttp) {
        //     return Apires::success($data, 'Data retrieved successfully', null, $count);
        // }

        return [
            'data' => $data,
            'count' => $count
        ];
    }
}
