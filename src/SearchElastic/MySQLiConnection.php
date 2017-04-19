<?php
namespace SearchElastic;

use SearchElastic\Connection\Connection;
/**
 * 
 */
class MySQLiConnection implements Connection
{
    public function getData($con,$query){
        $result = $con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
