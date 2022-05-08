<?php
use framework\dao\json\DAOJson;

try
{
    $alumno = DAOJson::getObjectByGuid( 'alumno3' );
    
    $alumno->nombres( 'Adriana María' );
    $alumno->dao()->update();
    print toHtml( $alumno );
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