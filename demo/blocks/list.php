<?php
use demo\json\model\Alumno;
use framework\dao\json\DAOJson;

try 
{
    $alumnos = DAOJson::listByClass( Alumno::class );
    print toHtml( $alumnos );
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