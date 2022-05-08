<?php
namespace demo\json\model;

use framework\dao\json\DAOJson;
use framework\dao\json\PersistentJson;

class Alumno extends PersistentJson
{

    /**
     * @var string
     */
    public $nombres;

    /**
     * @var string
     */
    public $apellidos;

    /**
     * @var string
     */
    public $email;

    /**
     * 
     * @param int $uid
     */
    public function __construct( string $guid )
    {
        parent::__construct( $guid );
    }

    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\json\PersistentJson::daoFactory()
     */
    protected function daoFactory(): DAOJson
    {
        return new DAOJson( $this );
    }

    /**
     * 
     * {@inheritDoc}
     * @see \framework\dao\json\PersistentJson::dao()
     */
    public function dao(): DAOJson
    {
        return parent::dao();
    }

    /**
     * 
     * @param string $nombres
     * @return string
     */
    public function nombres( string $nombres = NULL ): string
    {
        if( isset( $nombres ) )
        {
            $this->nombres = $nombres;
        }
        return $this->nombres;
    }
    
    /**
     * 
     * @param string $apellidos
     * @return string
     */
    public function apellidos( string $apellidos = NULL ): string
    {
        if( isset( $apellidos ) )
        {
            $this->apellidos = $apellidos;
        }
        return $this->apellidos;
    }
    
    /**
     * 
     * @param string $email
     * @return string
     */
    public function email( string $email = NULL ): string
    {
        if( isset( $email ) )
        {
            $this->email = $email;
        }
        return $this->email;
    }
    
}
