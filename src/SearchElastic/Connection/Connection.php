<?php
namespace SearchElastic\Connection;

/**
 * 
 */
interface Connection
{
    public function getData($con,$query);
}
