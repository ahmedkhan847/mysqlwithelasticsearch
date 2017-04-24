<?php
namespace SearchElastic\SearchAbstract;

use ElasticSearchClient\ElasticSearchClient;
use MySQLWithElasticsearchExceptions\SearchException;

/**
 * An abstract class for searching in Elasticsearch having an abstract search()
 * which will be implemented when extending from this class.
 */
abstract class SearchAbstract
{
    /** @var string|null Should contain the client of Elasticsearch from ElasticsearchClient class */
    protected $client = null;
    /** @var string|null Should contain the column name of Elasticsearch in which you like to search */
    protected $searchColumn = null;

    public function __construct()
    {
        $this->client = new ElasticSearchClient();
    }

    /**
     * Set Index to Use in Elasticsearch.
     *
     * @param  string  $index
     * @return void
     */
    public function setIndex($index)
    {
        $this->client->setIndex($index);
    }

    /**
     * Set Type to use in Elasticsearch
     *
     * @param  string  $type
     * @return void
     */
    public function setType($type)
    {
        $this->client->setType($type);
    }

    /**
     * Set Search Column to use for search in Elasticsearch
     *
     * @param  string  $value
     * @return void
     */
    public function setSearchColumn(string $value)
    {
        $this->searchColumn = $value;
    }

    /**
     * Function to extract Search Result From ElasticSearch
     *
     * @param  $query
     * @return void
     */
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

    /**
    * Function to validate Search
    * @param  string  $query
     * @return void
    */
    protected function validate($query)
    {
        if ($this->client->getIndex() == null) {
            throw new SearchException("Index cannot be null");
        }
        if ($this->client->getType() == null) {
            throw new SearchException("Type cannot be null");
        }
        if ($query == null) {
            throw new SearchException("Query can't be null");
        }
    }

    /**
     * Abstract function to be implement for search
     *
     * @param  string  $query
     * @return search result
     */
    abstract public function search($query);
}
