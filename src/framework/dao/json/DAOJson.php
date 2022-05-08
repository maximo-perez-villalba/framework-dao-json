<?php
namespace framework\dao\json;

use framework\dao\DAO;
use codemax\tool\json\entities\JsonEntity;
use framework\dao\Persistent;
use codemax\tool\repository\json\RepositoryJson;

class DAOJson extends DAO
{

    /**
     * 
     * @var RepositoryJson
     */
    static private $repository = null;

    /**
     * 
     * @param RepositoryJson $aRepository
     * @return RepositoryJson
     */
    static public function repository( RepositoryJson $aRepository = NULL ): RepositoryJson
    {
        if( isset( $aRepository ) )
        {
            self::$repository = $aRepository;
        }
        return self::$repository;
    }

    /**
     * 
     * @param string $filters
     * @param array $arguments
     * @return array
     */
    static public function read( string $filters = NULL, array $arguments = [] ): array
    {
        $result = [];
        if( isset( self::$repository ) && !empty( $arguments ) )
        {
            $value = '';
            $firstKey = array_key_first( $arguments );
            $value = strval( $arguments[ $firstKey ] );
            $result = self::$repository->read( $filters, $value );
        }
        return $result;
    }

    /**
     * 
     * @param string $aClassname
     * @return PersistentJson[]
     */
    static public function listByClass( string $aClassname ): array
    {
        return self::$repository->read( 'class', $aClassname );
    }
    
    /**
     * 
     * @param string $guid
     * @return PersistentJson|NULL
     */
    static public function getObjectByGuid( string $guid ): ?PersistentJson 
    {
        $object = NULL;
        $results = self::$repository->read( 'guid', $guid );
        if( !empty( $results ) )
        {
            $object = reset( $results );
        }        
        return $object;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\DAO::object()
     */
    public function object() : ?PersistentJson
    {
        return parent::object();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\DAO::create()
     */
    public function create(): bool
    {
        return self::$repository->create( $this->object() );
    }

    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\DAO::update()
     */
    public function update(): bool
    {
        return self::$repository->update( $this->object() );
    }

    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\DAO::delete()
     */
    public function delete(): bool
    {
        return self::$repository->delete( $this->object() );
    }
}

