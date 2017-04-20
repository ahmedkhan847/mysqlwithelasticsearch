<?php
namespace SyncMySql\Connection;

/**
 * An Interface with for database connection classes
 */
interface Connection
{
    /**
     * Get Data From Elasticsearch
     *
     * @param  string $con string  $query
     * @return Result from database
     */
    public function getData($con, $query);
}
