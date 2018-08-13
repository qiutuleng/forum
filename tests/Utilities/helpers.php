<?php

if (!function_exists('create')) {
    /**
     * @param $class
     * @param array $attributes
     * @param null $times
     * @return \Illuminate\Database\Eloquent\Model
     */
    function create($class, array $attributes = [], $times = null)
    {
        return factory($class)->times($times)->create($attributes);
    }
}

if (!function_exists('make')) {
    /**
     * @param $class
     * @param array $attributes
     * @param null $times
     * @return \Illuminate\Database\Eloquent\Model
     */
    function make($class, array $attributes = [], $times = null)
    {
        return factory($class)->times($times)->make($attributes);
    }
}

if (!function_exists('raw')) {
    /**
     * @param $class
     * @param array $attributes
     * @param null $times
     * @return array
     */
    function raw($class, array $attributes = [], $times = null)
    {
        return factory($class)->times($times)->raw($attributes);
    }
}