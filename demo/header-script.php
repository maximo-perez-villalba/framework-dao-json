<?php
include_once( dirname( __DIR__ ).'/vendor/autoload.php' );
use codemax\tool\repository\json\RepositoryJson;
use framework\dao\json\DAOJson;
use framework\environment\Env;

Env::init( '/app-config.php' );
DAOJson::repository( new RepositoryJson( Env::path( '/repository.json' ) ) );

/**
 * 
 * @param mixed $something
 * @return string
 */
function toHtml( $something ): string
{
    $html = '<pre style="display: block; height: 100%; width:100%; overflow: auto;">';
    if( is_null( $something ) )
    {
        $html .= 'NULL';
    }
    else
    {
        $html .= print_r( $something, TRUE );
    }
    $html .= '</pre>';
    return $html;    
}

/**
 * 
 * @return string
 */
function repositoryToHtml(): string 
{
    $html = '<pre style="display: block; height: 100%; width:100%; overflow: auto;">';
    $fileJson = file_get_contents( Env::path( '/repository.json' ) );
    $html .=  json_encode( json_decode( $fileJson ), JSON_PRETTY_PRINT) ;
    $html .= '</pre>';
    return $html;
}
