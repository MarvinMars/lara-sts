<?php

namespace App\Classes\Import\Interfaces;

interface Import
{
    /**
     * Read items from the specific files
     */
    public function read();

    /**
     * Working with the items
     */
    public function processing();

    /**
     * Return all items in the array
     * @return mixed
     */
    public function all();

}
