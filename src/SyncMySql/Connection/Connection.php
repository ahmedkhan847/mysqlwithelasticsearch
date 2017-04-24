<?php
namespace SyncMySql\Connection;

/**
 * An Interface for database connection classes
 */
interface Connection
{
    /**
     * Get Data From Elasticsearch
     *
     * @param string $con Database connectin string 
     * @param string  $query Select query to get data
     * @return Result from database
     */
    public function getData($con, $query);
}
