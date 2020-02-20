<?php

namespace Backpack\CRUD;

/**
 * I'd like to prevent send stats to fu**ing backpack.
 *
 * Trait CrudUsageStats
 * @package Backpack\CRUD
 */
trait CrudUsageStats
{
    private function runningInProduction()
    {
        if ($this->app->environment('local')) {
            return false;
        }

        if ($this->app->runningInConsole()) {
            return false;
        }

        if ($this->app->runningUnitTests()) {
            return false;
        }

        return true;
    }


    /**
     * Placeholder to prevent send stats.
     *
     * @return bool
     */
    private function sendUsageStats()
    {
        return true;
    }


    /**
     * Don't send anything.
     *
     * @param $method
     * @param $url
     * @param $payload
     *
     * @return bool
     */
    private function makeCurlRequest($method, $url, $payload)
    {
        return true;
    }


    /**
     * No guzzle, no huzzle.
     *
     * @param $method
     * @param $url
     * @param $payload
     *
     * @return bool
     */
    private function makeGuzzleRequest($method, $url, $payload)
    {
        return true;
    }
}
