<?php
use demo\json\model\Alumno;
use framework\dao\json\DAOJson;

try 
{
    $results = DAOJson::read( 'class', [ 'class' => Alumno::class ] );

    print toHtml( $results );
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
