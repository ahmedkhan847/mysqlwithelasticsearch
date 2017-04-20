<?php
namespace test;

require 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use SearchElastic\Search;

/**
 * 
 */
class MappingTest extends TestCase
{
    public function testSearch()
    {
        $search = new Search();
        $search->setIndex("blog");
        $search->setType("user");
        $search->setSearchColumn("name");
        $result = $search->search("ahmed khan");
        $this->assertCount(10, $result['result']);
    }
}
