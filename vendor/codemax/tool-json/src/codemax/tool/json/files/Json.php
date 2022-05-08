<?php
declare(strict_types=1);

namespace codemax\tool\json\files;

use codemax\tool\Path;
use stdClass;

/**
 *
 * @author Máximo
 *        
 */
class Json
{
    
    /**
     * 
     * @var string
     */
    const CONTENT_TYPE = 'application/json';
    
    /**
     * 
     * @var string
     */
    private $filepath = '';
    
    /**
     * 
     * @param string $filepath
     */
    public function __construct( string $filepath )
    {
        $this->filepath = Path::safe( $filepath );
    }
    
    /**
     * 
     * @param mixed $value
     */
    public function encode( $value )
    {
        file_put_contents( $this->filepath, json_encode( $value ) );
    }
    
    /**
     * 
     * @return stdClass
     */
    public function decodeToObject() : stdClass 
    {
        if ( file_exists( $this->filepath ) )
        {
            return json_decode( file_get_contents( $this->filepath ) );
        }
        else 
        {
            $data = new stdClass();
            $this->encode( $data );
            return $data;
        }
    }
    
    /**
     * 
     * @return array
     */
    public function decodeToArray() : array
    {
        if ( file_exists( $this->filepath ) )
        {
            return json_decode( file_get_contents( $this->filepath ), TRUE );
        }
        else
        {
            $data = [];
            $this->encode( $data );
            return $data;
        }
    }
    
    /**
     * 
     * @return string
     */
    public function filepath() : string
    {
        return $this->filepath;
    }
    
}