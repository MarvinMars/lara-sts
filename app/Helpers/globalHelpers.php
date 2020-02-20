<?php

use Illuminate\Database\Query\Builder;

if (!function_exists('dump_sql')) {
    /**
     * Dump sql from Builder
     *
     * @param Builder $builder
     */
    function dump_sql(Builder $builder)
    {
        $sql = $builder->toSql();
        $bindings = $builder->getBindings();
        foreach ($bindings as $binding) {
            $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        dump($sql);
    }
}

if (!function_exists('dd_sql')) {
    /**
     * * Dump sql from Builder with die execution of app
     *
     * @param Builder $builder
     */
    function dd_sql(Builder $builder)
    {
        dump_sql($builder);
        die;
    }
}

if (!function_exists('memory_usage')) {
    function memory_usage()
    {
        $mem_usage = memory_get_usage(true);

        if ($mem_usage < 1024) {
            return $mem_usage . " bytes";
        } elseif ($mem_usage < 1048576) {
            return round($mem_usage / 1024, 2) . " kilobytes";
        } else {
            return round($mem_usage / 1048576, 2) . " megabytes";
        }
    }
}

if (!function_exists('memory_peak_usage')) {
    function memory_peak_usage()
    {
        $mem_usage = memory_get_peak_usage(true);

        if ($mem_usage < 1024) {
            return $mem_usage . " bytes";
        } elseif ($mem_usage < 1048576) {
            return round($mem_usage / 1024, 2) . " kilobytes";
        } else {
            return round($mem_usage / 1048576, 2) . " megabytes";
        }
    }
}

if (!function_exists('random_color')) {
    /**
     * Generate random color
     *
     * @param bool $white
     * @param bool $black
     * @return string
     */
    function random_color($white = true, $black = true)
    {
        $start = 0;
        $end = 255;
        if (!$black) {
            $start = 10;
        }
        if (!$white) {
            $end = 245;
        }

        // ensure that values are in the range between 0 and 255
        $max_r = max($start, $end);
        $max_g = max($start, $end);
        $max_b = max($start, $end);

        // generate and return the random color
        return str_pad(dechex(rand(0, $max_r)), 2, '0', STR_PAD_LEFT) .
            str_pad(dechex(rand(0, $max_g)), 2, '0', STR_PAD_LEFT) .
            str_pad(dechex(rand(0, $max_b)), 2, '0', STR_PAD_LEFT);
    }
}