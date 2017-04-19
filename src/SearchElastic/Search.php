<?php
namespace SearchElastic;

use SearchElastic\SearchAbstract\SearchAbstract;
use ElasticSearchClient\ElasticSearchClient;

/**
 * 
 */
class Search extends SearchAbstract
{
    public function search($query)
    {
        $this->validate();
        $client = $this->client;
        $result = array();
        /* Change the match column name with the column name you want to search in it.*/
        $params = [
                'index' => $this->getIndex(),
                'type'  => $this->getType(),
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
