<?php
namespace test;

require 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use SyncMySql\SyncMySql;
use SyncMySql\Connection\MySQLiConnection;

/**
 * 
 */
class MappingTest extends TestCase
{
    public function testInsertAllData()
    {
        $sync = new SyncMySQL();
        $connection = new \PDO('mysql:host=localhost;dbname=laravel;', 'root', '');
        $sync->setIndex("blog");
        $sync->setType("user");
        $this->assertArrayHasKey("took", (array)$sync->insertAllData($connection, "users"));
    }

    public function testInsertAllDataWithDifferentQuery()
    {
        $sync = new SyncMySQL();
        $connection = new \PDO('mysql:host=localhost;dbname=laravel;', 'root', '');
        $sync->setIndex("blog");
        $sync->setType("post");
        $sync->setSqlQuery("SELECT id,title,body FROM posts");
        $this->assertArrayHasKey("took", (array)$sync->insertAllData($connection, "users"));
    }

    public function testDeleteSingleNode()
    {
        $sync = new SyncMySQL();
        $sync->setIndex("blog");
        $sync->setType("user");
        $this->assertEquals("deleted", $sync->deleteNode(21));
    }

    public function testInsertSingleNode()
    {
        $sync = new SyncMySQL();
        $connection = new \PDO('mysql:host=localhost;dbname=laravel;', 'root', '');
        $sync->setIndex("blog");
        $sync->setType("user");
        $this->assertEquals("created", $sync->insertNode($connection, 21, "users"));
    }

    public function testUpdateSingleNodeWithMySQLi()
    {
        $sync = new SyncMySQL();
        $connection = new \mysqli('localhost', 'root', '', 'laravel');
        $sync->setIndex("blog");
        $sync->setType("user");
        $sync->setConnection(new MySQLiConnection());
        //Assert Fails
        $this->assertEquals("updated", $sync->updateNode($connection, 21,"users"));
    }
}
