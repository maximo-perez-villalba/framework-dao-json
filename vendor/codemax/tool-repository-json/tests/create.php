<?php
use codemax\tool\repository\json\RepositoryJson;
use framework\environment\Env;
use tests\codemax\tool\repository\json\Something;

include_once __DIR__.'/header-script.php';

$repository = new RepositoryJson( Env::path( '/tests-repository.json' ) );

$something01 = new Something( 'Algo04' );
$something01->featureA( 'Carla no esta, Carla se fue...' );
$something01->featureB( new stdClass() );
$something01->featureC( [ 'I','You',11 ] );

$repository->create( $something01 );

//Env::console( $repository );