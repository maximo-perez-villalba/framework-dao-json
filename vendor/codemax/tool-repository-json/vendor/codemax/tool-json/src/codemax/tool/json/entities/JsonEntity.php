<?php
declare( strict_types=1 );

namespace codemax\tool\json\entities;

use codemax\tool\json\files\Json;
use JsonSerializable;
use stdClass;

/**
 *
 * @author Máximo
 *        
 */
class JsonEntity implements JsonSerializable
{
    
    /**
     * 
     * @var stdClass
     */
    protected $data = null;
    
    /**
     * 
     * @var Json
     */
    protected $fileJson = null;

    /**
     * 
     * @param string $filepath
     * @param string|array|object|stdClass $source
     * @return JsonEntity
     */
    static public function fromSource( string $filepath, $source ) : JsonEntity
    {
        $entity = new JsonEntity( $filepath, TRUE );
        if ( is_object( $source ) && ( get_class( $source ) == stdClass::class ) )
        {
            $entity->data = $source;
        }
        else
        {
            $entity->data =  json_decode( json_encode( $source ) );
        }
        return $entity;
    }
    
    /**
     * 
     * @return string
     */
    public function filepath() : string
    {
        return $this->fileJson->filepath();
    }
    
    /**
     * 
     * @param string $filepath
     * @param bool $lazyLoad
     */
    public function __construct( string $filepath, bool $lazyLoad = false )
    {
        $this->fileJson = new Json( $filepath );
        if ( !$lazyLoad )
        {
            $this->data = $this->fileJson->decodeToObject();
        }
    }
    
    /**
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize ()
    {
        return $this->data();
    }
    
    /**
     * 
     * @return stdClass
     */
    public function data() : stdClass
    {
        if ( is_null( $this->data ) )
        {
            $this->data = $this->fileJson->decodeToObject();
        }
        return $this->data;
    }
    
    /**
     * 
     */
    public function sincronize()
    {
        $this->fileJson->encode( $this->data() );
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
    
    /**
     * 
     * @param string $guid
     * @return string
     */
    public function guid( string $guid = null ) : string
    {
        if ( isset( $guid ) )
        {
            $this->data()->guid = $guid;
        }
        if ( isset( $this->data()->guid ) )
        {
            return $this->data()->guid;
        }
        return '';
    }
    
}