<?php
use codemax\tool\repository\json\RepositoryJson;
use framework\environment\Env;

include_once __DIR__.'/header-script.php';

$repository = new RepositoryJson( Env::path( '/tests-repository.json' ) );

$list = $repository->read( 'guid', 'Algo03' );

if( !empty( $list ) && is_object( $list[ 0 ] ) )
{
    if ( $repository->delete( $list[ 0 ] ) ) 
    {
        Env::console( "Object deleted - OK" );
    }
    else
    {
        Env::console( "Object deleted - FAIL" );
    }
}
else 
{
    Env::console( 'Error: RepositoryJson::read filter guid not found.' );
}

