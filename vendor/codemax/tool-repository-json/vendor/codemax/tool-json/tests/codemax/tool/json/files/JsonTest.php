<?php
declare(strict_types=1);

namespace tests\codemax\tool\json\files;

use PHPUnit\Framework\TestCase;
use codemax\tool\json\files\Json;
use stdClass;

class JsonTest extends TestCase
{
    
    /**
     * 
     * @var string
     */
    private $jsonFilePath = null;
    
    /**
     * 
     * @var stdClass
     */
    private $jsonBody = null;
    
    public function setUp(): void
    {
        $this->jsonFilePath = __DIR__.DIRECTORY_SEPARATOR.'test.json';
        
        $this->jsonBody = new stdClass();
        $this->jsonBody->uid = md5( random_bytes( 32 ) );
        $this->jsonBody->classname = get_called_class();
        
        file_put_contents( $this->jsonFilePath, json_encode( $this->jsonBody ) );        
    }
    
    public function tearDown(): void
    {
        unlink( $this->jsonFilePath );
        $this->jsonBody = null;
    }
    
    public function testFilepath()
    {
        $jsonFile = new Json( $this->jsonFilePath );
        
        $this->assertEquals( $this->jsonFilePath , $jsonFile->filepath() );
    }
    
    public function testEncode()
    {
        $json = new Json( $this->jsonFilePath );        
        $json->encode( $this->jsonBody );
        
        $fileMD5 = md5_file( $this->jsonFilePath );
        $nativeMD5 = md5( json_encode( $this->jsonBody ) );
        
        $this->assertEquals( $nativeMD5, $fileMD5 );
    }
    
    public function testDecodeToObject()
    {
        $json = new Json( $this->jsonFilePath );        
        $this->assertEquals( stdClass::class, get_class( $json->decodeToObject() ) );
    }
    
    public function testDecodeToArray()
    {
        $json = new Json( $this->jsonFilePath );
        $this->assertTrue( is_array( $json->decodeToArray() ) );
    }
}