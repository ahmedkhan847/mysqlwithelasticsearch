<?php
namespace SyncMySql\Connection;

use SyncMySql\Connection\Connection;

/**
 * Class to handle PDO connection
 */
class YiiConnection implements Connection
{
    /**
     * Get Data From Elasticsearch
     *
     * @param string $con Database connection string 
     * @param string  $query Select query to get data
     * @return Result from database
     */
    public function getData($model, $query = null)
    {
        $data = [];
        foreach ($model as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }
}