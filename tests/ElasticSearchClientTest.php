<?php
namespace test;

require 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use ElasticSearchClient\ElasticSearchClient;

/**
 * 
 */
class ElasticSearchClientTest extends TestCase
{
    public function testGetClient()
    {
        $client = new ElasticSearchClient();
        $this->assertArrayHasKey('transport', (array)$client->getClient());
    }

    public function testSetIndex()
    {
        $client = new ElasticSearchClient();
        $this->assertEmpty($client->setIndex("index"));
    }

    public function testSetType()
    {
        $client = new ElasticSearchClient();
        $this->assertEmpty($client->setType("asd"));
    }

    public function testgetIndex()
    {
        $client = new ElasticSearchClient();
        $client->setIndex("index");
        $this->assertEquals("index", $client->getIndex());
    }

    public function testGetType()
    {
        $client = new ElasticSearchClient();
        $client->setType("type");
        $this->assertEquals("type", $client->getType());
    }
}
