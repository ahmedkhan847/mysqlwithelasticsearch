<?php
namespace test;

require 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use ElasticSearchClient\Mapping;

/**
 * 
 */
class MappingTest extends TestCase
{
    public function testCreateMapping()
    {
        $mapping = new Mapping();
        $map = ['index' => 'blog',
            'body' => [
            'mappings' => [
                            'article' => [
                                'properties' => [
                                    'id' => [
                                        'type' => 'integer'
                                    ],
                                    'article_name' => [
                                        'type' => 'string'
                                    ],
                                    'article_content' => [
                                        'type' => 'string'
                                    ],
                                    'article_url' => [
                                        'type' => 'string'
                                    ],
                                    'category_name' => [
                                        'type' => 'string'
                                    ],
                                    'username' => [
                                        'type' => 'string'
                                    ],
                                    'date' => [
                                        'type' => 'date',
                                        'format' => 'dd-MM-yyyy'
                                    ],
                                    'article_img' => [
                                        'type' => 'string'
                                    ],
                                ]
                            ]
                        ]
                ]
            ];
        $this->assertTrue($mapping->createMapping($map));
    }

    public function testDeleteMapping()
    {
        $mapping = new Mapping();
        $this->assertTrue($mapping->deleteMapping("blog"));
    }

    public function testDeleteMappingFail()
    {
        $mapping = new Mapping();
        $this->assertTrue($mapping->deleteMapping("blog"));
    }
}
