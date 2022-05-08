<?php
namespace framework\dao\json;

use codemax\tool\repository\json\IRepositoryObject;
use framework\dao\Persistent;

abstract class PersistentJson extends Persistent implements IRepositoryObject
{
    
    /**
     * 
     * @var string
     */
    private $guid = '';
    
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
     * @return string
     */
    public function guid(): string
    {
        return $this->guid;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\Persistent::dao()
     */
    public function dao(): DAOJson
    {
        return parent::dao();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\Persistent::daoFactory()
     */
    protected function daoFactory(): DAOJson
    {
        return new DAOJson( $this );
    }
    
}