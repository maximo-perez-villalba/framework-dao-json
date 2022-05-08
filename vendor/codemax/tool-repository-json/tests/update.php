<?php
use codemax\tool\repository\json\RepositoryJson;
use framework\environment\Env;

include_once __DIR__.'/header-script.php';

$repository = new RepositoryJson( Env::path( '/tests-repository.json' ) );

$list = $repository->read( 'guid', 'Algo03' );

if( !empty( $list ) && is_object( $list[ 0 ] ) )
{
    $something = $list[ 0 ];
    $something->featureA( 'Dalma Maradona' );
    $repository->update( $something );
    Env::console( $something );
}
else 
{
    Env::console( 'Error: RepositoryJson::read filter guid not found.' );
}

