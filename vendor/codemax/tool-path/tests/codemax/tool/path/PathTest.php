<?php
namespace tests\codemax\tool\path;

use PHPUnit\Framework\TestCase;
use codemax\tool\Path;

final class PathTest extends TestCase
{
    
    private $infoPath = NULL;
    
    public function setUp(): void
    {
        $this->infoPath = pathinfo(  __FILE__ );
    }
    
    public function dirname() : string
    {
        return $this->infoPath[ 'dirname' ];
    }
    
    public function basename() : string
    {
        return $this->infoPath[ 'basename' ];
    }
    
    public function extension() : string
    {
        return $this->infoPath[ 'extension' ];
    }
    
    public function filename() : string
    {
        return $this->infoPath[ 'filename' ];
    }
    
    public function testSafe()
    {
        $this->assertEquals( 
            __FILE__, 
            Path::safe( "{$this->dirname()}/{$this->basename()}" ) 
        );
        $this->assertEquals( 
            __FILE__, 
            Path::safe( "{$this->dirname()}\\{$this->basename()}" ) 
        );
    }

    public function testFileExtension()
    {
        $this->assertEqualsCanonicalizing( 'php' , $this->extension() );                
    }
    
    public function testForceCreateFilepath()
    {
        $newFile = "{$this->dirname()}/directory/filename.txt";
        Path::forceCreateFilepath( $newFile );
        
        $this->assertTrue( file_exists( $newFile ) );
        
        unlink( $newFile );
        rmdir( Path::safe( "{$this->dirname()}/directory" ) );
    }
    
    public function textDeleteEntireDirectory()
    {
        Path::forceCreateFilepath( "{$this->dirname()}/directory/file1.txt" );
        Path::forceCreateFilepath( "{$this->dirname()}/directory/sub-directory/file2.txt" );
        
        Path::deleteEntireDirectory( "{$this->dirname()}/directory" );
        
        $this->assertFalse( file_exists( "{$this->dirname()}/directory" ) );
        
    }
    
    public function testForceDirBase()
    {
        $this->assertEquals( 
            $this->dirname().DIRECTORY_SEPARATOR, 
            Path::forceDirBase( $this->dirname() ) 
        );
    }
    
}