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
     * @param string $model Yii2 model 
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

    /**
     * Get Data From Elasticsearch
     *
     * @param string $model Yii2 model  
     * @param string  $query Select query to get data
     * @return Result from database
     */
    public function getAllData($models, $query = null)
    {
        $data = [];
        foreach ($models as $key => $model) {
            foreach ($model as $key2 => $value) {
                $data[$key][$key2] = $value;
            }
        }
        return $data;
    }
}