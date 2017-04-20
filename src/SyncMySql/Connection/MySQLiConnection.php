<?php
namespace SyncMySql\Connection;

use SyncMySql\Connection\Connection;

/**
 * Class to handle MySqli Object Oriented connection
 */
class MySQLiConnection implements Connection
{
    /**
     * Get data from database.
     *
     * @param  string $con string  $query
     * @return Result from database
     */
    public function getData($con, $query)
    {
        $result = $con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
