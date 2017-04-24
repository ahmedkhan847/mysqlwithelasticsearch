<?php
namespace SyncMySql\Connection;

use SyncMySql\Connection\Connection;

/**
 * Class to handle MySqli Object Oriented connection
 */
class MySQLiConnection implements Connection
{
    /**
     * Get Data From Elasticsearch
     *
     * @param string $con Database connectin string 
     * @param string  $query Select query to get data
     * @return Result from database
     */
    public function getData($con, $query)
    {
        $result = $con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
