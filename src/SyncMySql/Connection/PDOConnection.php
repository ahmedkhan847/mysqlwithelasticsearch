<?php
namespace SyncMySql\Connection;

use SyncMySql\Connection\Connection;

/**
 * Class to handle PDO Object Oriented connection
 */
class PDOConnection implements Connection
{
    /**
     * Search in Elasticsearch.
     *
     * @param  string $con string  $query
     * @return Result from database
     */
    public function getData($con, $query)
    {
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
