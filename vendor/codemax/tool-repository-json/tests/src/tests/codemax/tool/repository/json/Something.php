<?php
namespace tests\codemax\tool\repository\json;

use codemax\tool\repository\json\IRepositoryObject;

class Something implements IRepositoryObject
{

    /**
     * Global unique identificator 
     * @var string
     */
    public $guid = '';
    
    /**
     * 
     * @var string
     */
    public $featureA = '';
    
    /**
     * 
     * @var object
     */
    public $featureB = NULL;
    
    /**
     * 
     * @var array
     */
    public $featureC = [];
    
    /**
     * 
     * @param string $guid
     */
    public function __construct( string $guid ) 
    {
        $this->guid = $guid;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \codemax\tool\repository\json\IRepositoryObject::guid()
     */
    public function guid(): string
    {
        return $this->guid;
    }
    
    /**
     * 
     * @param string $featureTxt
     * @return string
     */
    public function featureA( string $featureTxt = NULL ): string
    {
        if( isset( $featureTxt ) )
        {
            $this->featureA = $featureTxt;
        }
        return $this->featureA;
    }
    
    /**
     * 
     * @param string $featureObject
     * @return object|NULL
     */
    public function featureB( object $featureObject = NULL ): ?object
    {
        if( isset( $featureObject ) )
        {
            $this->featureB = $featureObject;
        }
        return $this->featureB;
    }
    
    /**
     * 
     * @param string $featureTxt
     * @return array
     */
    public function featureC( array $featureArray = NULL ): array
    {
        if( isset( $featureArray ) )
        {
            $this->featureC = $featureArray;
        }
        return $this->featureC;
    }
    
}

