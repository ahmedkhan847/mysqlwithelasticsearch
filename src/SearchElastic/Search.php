<?php
namespace SearchElastic;

use SearchElastic\SearchAbstract\SearchAbstract;

/**
 *  Class to perform basic search
 */
class Search extends SearchAbstract
{
    /**
     * Search in Elasticsearch.
     *
     * @param  string  $query
     * @return Result from elasticsearch
     */
    public function search($query)
    {
        $this->validate($query);
        $client = $this->client->getClient();
        $result = array();
        /* Change the match column name with the column name you want to search in it.*/
        $params = [
                'index' => $this->client->getIndex(),
                'type'  => $this->client->getType(),
                'body'  => [
                    'query' => [
                        'match' => [ $this->searchColumn => $query],
                    ],
                ],
            ];
        $query  = $client->search($params);
            
        return  $this->extractResult($query);
    }
}
