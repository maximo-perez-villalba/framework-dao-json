<?php
declare( strict_types=1 );

namespace codemax\tool\json\entities\models;

use JsonSerializable;
use stdClass;

/**
 *
 * @author Máximo
 *        
 */
class JsonModel implements JsonSerializable
{
    
    /**
     *
     * @var stdClass
     */
    protected $data = null;

    /**
     * 
     * @param array|stdClass|null $jsonSource
     */
    public function __construct( $jsonSource = NULL )
    {
        if ( isset( $jsonSource ) )
        {
            $this->data = $jsonSource;
        }
        else
        {
            $this->data = new stdClass();
            $this->classname( static::class );
        }
    }
    
    /**
     * 
     * @return stdClass
     */
    public function data() : stdClass
    {
        return $this->data;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize ()
    {
        return $this->data;
    }
    
    /**
     * 
     * @param string $classname
     * @return string
     */
    public function classname( string $classname = null ) : string
    {
        if ( isset( $classname ) )
        {
            $this->data()->classname = $classname;
        }
        if ( isset( $this->data()->classname ) )
        {
            return $this->data()->classname;
        }
        return '';
    }
    
}