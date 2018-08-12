<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * The data is not in request. It's a complement to request data.
     *
     * @var array
     */
    protected $notInRequestData = [];

    /**
     * The Eloquent builder.
     *
     * @var QueryBuilder|EloquentBuilder
     */
    protected $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
//        'by', // The field and filter method all are "by".
//        'by' => 'byUsername', // The field is "by" and the filter method is "byUserName".
    ];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param QueryBuilder|EloquentBuilder $builder
     * @param array $notInRequestData
     * @return EloquentBuilder|QueryBuilder
     */
    public function apply($builder, array $notInRequestData = [])
    {
        $this->builder = $builder;
        $this->notInRequestData = $notInRequestData;

        foreach ($this->getFilters() as $field => $value) {
            $this->applyFilterMethod($field, $value);
        }

        return $this->builder;
    }

    /**
     * Check the request is has a filter field.
     *
     * @param $field
     * @return bool
     */
    protected function hasFilterField($field)
    {
        return $this->request->has($field);
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    protected function getFilters()
    {
        return array_merge(
            $this->request->all($this->getFilterFields()),
            $this->getNotInRequestData()
        );
    }

    /**
     * Fetch all valid keys from the not in request data.
     *
     * @return array
     */
    protected function getValidNotInRequestDataKeys()
    {
        return array_intersect($this->getFilterFields(), array_keys($this->notInRequestData));
    }

    /**
     * Fetch all data from the not in request data.
     *
     * @return array
     */
    protected function getNotInRequestData()
    {
        $keys = $this->getValidNotInRequestDataKeys();
        return array_combine($keys, array_map(function ($key) {
            return $this->notInRequestData[$key];
        }, $keys));
    }

    /**
     * Get all filter fields.
     *
     * @return array
     */
    protected function getFilterFields()
    {
        return array_map(function ($field, $method) {
            return is_string($field) ? $field : $method;
        }, array_keys($this->filters), $this->filters);
    }

    /**
     * Get filter method name by a field.
     *
     * @param $field
     * @return mixed
     */
    protected function getFilterMethodByField($field)
    {
        return key_exists($field, $this->filters) ? $this->filters[$field] : $field;
    }

    /**
     * Apply filter by the filter method.
     *
     * @param $field
     * @param $value
     */
    protected function applyFilterMethod($field, $value)
    {
        $method = $this->getFilterMethodByField($field);

        if (method_exists($this, $method)) {
            $this->{$method}($value);
        }
    }
}
