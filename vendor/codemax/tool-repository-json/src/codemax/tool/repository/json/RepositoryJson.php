<?php
namespace codemax\tool\repository\json;

use codemax\tool\TXT;
use codemax\tool\json\entities\JsonEntity;
use framework\environment\Env;
use Exception;
use JsonMapper;
use stdClass;

class RepositoryJson extends JsonEntity
{
    /**
     * 
     * @var string
     */
    static protected $key_separator = '@#';
    
    /**
     * 
     * @param string $filepath
     * @param bool $lazyLoad
     */
    public function __construct( string $filepath, bool $lazyLoad = false )
    {
        parent::__construct( $filepath, $lazyLoad );    
        
        if ( !isset( $this->data()->map ) )
        {
            $this->data()->map = new stdClass();
            $this->sincronize();
        }        
    }

    /**
     * 
     * @param IRepositoryObject $anObject
     * @return string
     */
    protected function key( IRepositoryObject $anObject ): string
    {
        return get_class( $anObject ).self::$key_separator.$anObject->guid();
    }

    /**
     * $filter = 'class', $value = fullClassName
     * $filter = 'guid', $value = aGuidValue
     * 
     * @param string $filter
     * @param string $value
     * @return array
     */
    public function read( string $filter = NULL, string $value ): array
    {
        $results = [];
        $filter = trim( strtolower( $filter ) );
        $mapper = new JsonMapper();
        foreach ( $this->data()->map as $key => $source )
        {
            $keyTXT = TXT::create( $key );
            $value = trim( $value );
            if( $filter == 'class' )
            {
                if( $keyTXT->startWith( $value ) )
                {
                    $guid = $keyTXT->lastPart( self::$key_separator );
                    $object = new $value( $guid );
                    $results[] = $mapper->map( json_decode( $source ), $object );
                }
            }
            elseif( $filter == 'guid' )
            {
                if( $keyTXT->endWith( $value ) )
                {
                    $classname = $keyTXT->firstPart( self::$key_separator );
                    $object = new $classname( $value );
                    $results[] = $mapper->map( json_decode( $source ), $object );
                }
            }
        }        
        return $results;
    }
    
    /**
     * 
     * @param object $anObject
     * @return bool
     */
    public function create( IRepositoryObject $anObject ): bool
    {
        $repositoryObjectKey = $this->key( $anObject );
        if ( isset( $this->data()->map->$repositoryObjectKey ) )
        {
            throw new Exception( 'Error: Integrity constraint violation, key object exist in the repository. ' );
        }
        $this->data()->map->$repositoryObjectKey = json_encode( $anObject );
        $this->sincronize();
        
        return TRUE;
    }
    
    /**
     * 
     * @param object $anObject
     * @return bool
     */
    public function update( IRepositoryObject $anObject ): bool
    {
        $operationResponse = FALSE;
        $repositoryObjectKey = $this->key( $anObject );
        if ( isset( $this->data()->map->$repositoryObjectKey ) )
        {
            $this->data()->map->$repositoryObjectKey = json_encode( $anObject );
            $this->sincronize();
            $operationResponse = TRUE;
        }
        return $operationResponse;
    }

    /**
     * 
     * @param IRepositoryObject $anObject
     * @return bool
     */
    public function delete( IRepositoryObject $anObject ): bool
    {
        $operationResponse = FALSE;
        $repositoryObjectKey = $this->key( $anObject );
        if ( isset( $this->data()->map->$repositoryObjectKey ) )
        {
            unset( $this->data()->map->$repositoryObjectKey );
            $this->sincronize();
            $operationResponse = TRUE;
        }
        return $operationResponse;
    }
}
