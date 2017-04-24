<?php
namespace SyncMySql\Connection;

use SyncMySql\Connection\Connection;

/**
 * Class to handle PDO connection
 */
class PDOConnection implements Connection
{
    /**
     * Get Data From Elasticsearch
     *
     * @param string $con Database connection string 
     * @param string  $query Select query to get data
     * @return Result from database
     */
    public function getData($con, $query)
    {
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
