<?php
namespace SearchElastic;

use SearchElastic\Connection\Connection;
/**
 * 
 */
class PDOConnection implements Connection
{
    public function getData($con,$query){
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
