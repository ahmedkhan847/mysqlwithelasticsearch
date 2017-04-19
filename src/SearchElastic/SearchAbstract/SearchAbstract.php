<?php
namespace SearchElastic\SearchAbstract;

use ElasticSearchClient\ElasticSearchClient;
use SearchElastic\SyncMySql;
/**
 * 
 */
abstract class SearchAbstract extends SyncMySql 
{
    protected $client = null;
    protected $searchColumn = null;

    public function __construct()
    {
       
       $this->client = ElasticSearchClient::getClient();
    }

    public function setSearchColumn(string $value)
    {
        $this->searchColumn = $value;
    }

    protected function extractResult($query)
    {
        $result = null;
        $i = 0;
        $hits                  = sizeof($query['hits']['hits']);
        $hit                   = $query['hits']['hits'];
        $result['searchfound'] = $hits;
        while ($i < $hits) {
            $result['result'][$i] = $query['hits']['hits'][$i]['_source'];
            
            $i++;
        }
        return $result;
    }
    public abstract function search($query);
}
