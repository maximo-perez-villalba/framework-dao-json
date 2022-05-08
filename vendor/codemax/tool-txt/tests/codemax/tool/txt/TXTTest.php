<?php
namespace tests\codemax\tool\txt;

use PHPUnit\Framework\TestCase;
use codemax\tool\TXT;


/**
 *
 * @author Máximo Perez Villalba
 *        
 */
class TXTTest extends TestCase
{
    
    /**
     * 
     * @var string
     */
    private $txtExample = NULL;

    /**
     * 
     * @var TXT
     */
    private $txt = NULL;
    
    /**
     * 
     * {@inheritDoc}
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->txtExample = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget. ';
        $this->txt = TXT::create( $this->txtExample );
    }
    
    public function testEquals()
    {
        $this->assertTrue( $this->txt->equals( $this->txtExample ) ); 
        $this->assertFalse( $this->txt->equals( "{$this->txtExample}..." ) );
    }
    
    public function testCompare()
    {
        //text == otherText
        $this->assertTrue( $this->txt->compare( $this->txtExample ) === 0 );
        //text < otherText
        $this->assertTrue( $this->txt->compare( "{$this->txtExample}..." )  < 0 );
        //text > otherText
        $otherTxt = substr( $this->txtExample, 0, strlen( $this->txtExample ) / 2 );
        $this->assertTrue( $this->txt->compare( $otherTxt )  > 0 );
    }
    
    public function testContains()
    {
        $distance = strlen( $this->txtExample ) / 3;
        $otherTxt = substr( $this->txtExample, $distance, $distance );
        $this->assertTrue( $this->txt->contains( $otherTxt ) );
        $this->assertFalse( $this->txt->contains( "*{$otherTxt}*" ) );
    }
    
    public function testStartWith()
    {
        $prefix = substr( $this->txtExample, 0, strlen( $this->txtExample ) / 3 );
        $this->assertTrue( $this->txt->startWith( $prefix ) );
        $this->assertFalse( $this->txt->startWith( ".{$prefix}" ) );
    }
    
    public function testEndWith()
    {
        $posfix = substr( $this->txtExample, ( strlen( $this->txtExample ) / 3 ) * -1 );
        $this->assertTrue( $this->txt->endWith( $posfix ) );
        $this->assertFalse( $this->txt->endWith( ".{$posfix}" ) );
    }
    
    public function testFirstPart()
    {
        $separator = ', ';
        $firstPart = 'Lorem ipsum dolor sit amet';
        $this->assertEquals( $firstPart, $this->txt->firstPart( $separator ) );
        $this->assertEquals( "{$firstPart}{$separator}", $this->txt->firstPart( $separator, TRUE ) );
    }
    
    public function testLastPart()
    {
        $separator = 'elit. ';
        $lastPart = 'Quisque eget. ';
        $this->assertEquals( $lastPart, $this->txt->lastPart( $separator ) );
        $this->assertEquals( "{$separator}{$lastPart}", $this->txt->lastPart( $separator, TRUE ) );
    }
    
    public function testToCamelCaseClass()
    {
        $origin = 'mAke_mE camel-case pLEase';
        $expected = 'MakeMeCamelCasePlease';
        $this->assertEquals( $expected , TXT::create( $origin )->toCamelCaseClass() );
    }
    
    public function testToCamelCaseVariable()
    {
        $origin = 'mAke_mE camel-case pLEase';
        $expected = 'makeMeCamelCasePlease';
        $this->assertEquals( $expected , TXT::create( $origin )->toCamelCaseVariable() );
    }
    
}