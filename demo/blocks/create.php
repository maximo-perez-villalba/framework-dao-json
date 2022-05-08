<?php 
use demo\json\model\Alumno;
use framework\dao\json\DAOJson;
use framework\environment\Env;

try
{
    $alumno = new Alumno( 'alumno1' );
    $alumno->nombres( 'Marcos' );
    $alumno->apellidos( 'Baldivia' );
    $alumno->email( 'marcos.baldivia@prueba.com' );
    
    $alumno->dao()->create();
    
    print "<h6>Objeto de la clase Alumno creado en el repositorio</h6>";
    print '<hr>';
    print toHtml( $alumno );
}
catch ( Exception $e )
{
    print "<h6>Probablemente debería ejecutar DAO::delete.</h6>";
    print '<hr>';
    print toHtml( $e );
}
finally
{
    print '<hr>';
    print repositoryToHtml();
}