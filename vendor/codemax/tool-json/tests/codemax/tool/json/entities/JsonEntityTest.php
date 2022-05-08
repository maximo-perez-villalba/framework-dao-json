<?php
declare( strict_types=1 );

namespace tests\codemax\tool\json\entities;

use PHPUnit\Framework\TestCase;
use codemax\tool\json\entities\JsonEntity;
use codemax\tool\json\files\Json;

class JsonEntityTest extends TestCase
{
    
    /**
     *
     * @var string
     */
    private $jsonFilePath = null;
    
    /**
     *
     * @var JsonEntity
     */
    private $jsonEntity = null;
    
    public function setUp(): void
    {
        $this->jsonFilePath = __DIR__.DIRECTORY_SEPARATOR.'test.json';
        
        $this->jsonEntity = new JsonEntity( $this->jsonFilePath );
        $this->jsonEntity->guid( md5( random_bytes( 32 ) ) );
        $this->jsonEntity->classname( get_called_class() );
        $this->jsonEntity->sincronize();
    }
    
    public function tearDown(): void
    {
        unlink( $this->jsonFilePath );
        $this->jsonEntity = null;
    }
    
    public function testData()
    {
        $fileJson = new Json( $this->jsonFilePath );
        
        $this->assertTrue( $this->jsonEntity->data() == $fileJson->decodeToObject() );
    }
    
    public function testClassname()
    {
        $this->assertEquals( get_called_class(), $this->jsonEntity->classname() );
        $this->assertEquals( $this->jsonEntity->data()->classname, $this->jsonEntity->classname() );
    }
    
    public function testGuid()
    {
        $this->assertEquals( $this->jsonEntity->data()->guid, $this->jsonEntity->guid() );
    }
    
    public function testSincronize()
    {
        $entityJson = JsonEntity::fromSource( $this->jsonFilePath, $this->jsonEntity->data() );
        $this->assertTrue( $this->jsonEntity == $entityJson );
    }
}