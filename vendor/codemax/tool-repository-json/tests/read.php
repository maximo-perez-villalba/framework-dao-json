<?php
use codemax\tool\repository\json\RepositoryJson;
use framework\environment\Env;
use tests\codemax\tool\repository\json\Something;

include_once __DIR__.'/header-script.php';

$repository = new RepositoryJson( Env::path( '/tests-repository.json' ) );

// read from guid filter
Env::console( $repository->read( 'guid', 'Algo03' ) );
// read from class filter
Env::console( $repository->read( 'class', Something::class ) );