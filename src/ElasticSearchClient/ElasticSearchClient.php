<?php
namespace ElasticSearchClient;

use Elasticsearch\ClientBuilder;

/**
 * Elasticsearch Client class
 */
class ElasticSearchClient
{
    private $index = null;
    private $type = null;

    /**
     * Set Index to Use in Elasticsearch.
     *
     * @param  string  $index
     * @return void
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * Set Type to use in Elasticsearch
     *
     * @param  string  $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get Index to use in Elasticsearch.
     *
     * @return index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Get Type to use in Elasticsearch.
     *
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get Elasticsearch Client.
     *
     * @return ClientBuilder
     */
    public function getClient()
    {
        return ClientBuilder::create()->build();
    }
}
