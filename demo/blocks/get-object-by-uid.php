<?php
use framework\dao\json\DAOJson;

try 
{
    $alumno = DAOJson::getObjectByGuid( 'alumno3' );
    
    if( is_null( $alumno ) )
    {
        print "<h6>Probablemente debería ejecutar DAO::create.</h6>";
        print '<hr>';
    }
    else
    {
        print toHtml( $alumno );
    }
} 
catch ( Exception $e ) 
{
    print toHtml( $e );
}
finally
{
    print '<hr>';
    print repositoryToHtml();
}