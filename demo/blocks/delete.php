<?php
use framework\dao\json\DAOJson;

try
{
    $alumno = DAOJson::getObjectByGuid( 'alumno1' );
    
    if( is_object( $alumno ) )
    {
        $responseDB = $alumno->dao()->delete();
        
        if( $responseDB )
        {
            print "<h6>Alumno eliminado del repositorio.</h6>";
            print '<hr>';
            print toHtml( $alumno );
        }
    }
    else
    {
        print "<h6>El alumno no existe en el repositorio, tal vez deberías crearlo o hacer una busqueda diferente.</h6>";
    } 
}
catch ( Exception $e )
{
    print "<h6>You should probably run DAO::create.</h6>";
    print '<hr>';
    print toHtml( $e );
}
finally
{
    print '<hr>';
    print repositoryToHtml();
}