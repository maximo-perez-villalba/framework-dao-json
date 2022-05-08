<?php
namespace codemax\tool;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 *
 * @author Máximo Villalba
 *        
 */
abstract class Path 
{
    
	/**
	 * 
	 * @param string $path
	 * @return string
	 */
	static public function safe( string $path ): string 
	{ 
	    if ( file_exists( $path ) ) 
	    {
	        return realpath( $path ); 
	    }
	    else 
	    {
	        return str_replace( [ '/', '\\' ] , DIRECTORY_SEPARATOR, $path );
	    }
	}
	
	/**
	 * 
	 * @param string $path
	 * @return string
	 */
	static public function fileExtension( string $path ) : string
	{
		return strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
	}
	
	/**
	 * 
	 * @param string $filepath
	 */
	static public function forceCreateFilepath( string $filepath )
	{
	    $filepath = self::safe( $filepath );
	    if ( !file_exists( $filepath ) )
	    {
	        $directoryPath = dirname( $filepath );
	        if ( !file_exists( $directoryPath ) )
	        {
	            mkdir( $directoryPath , 0777, true );
	        }
	        touch( $filepath );
	    }
	}
	
	/**
	 * 
	 * @param string $dirPath
	 * @return string
	 */
	static public function forceDirBase( string $dirPath ) : string
	{
	    $dirPath = self::safe( $dirPath );
	    if ( substr( $dirPath, -1 ) != DIRECTORY_SEPARATOR ) 
	    {
	        $dirPath .= DIRECTORY_SEPARATOR;
	    }
	    return $dirPath;
	}

	/**
	 * 
	 * @param string $dirPath
	 */
	static public function deleteEntireDirectory( string $dirPath ): void
	{
	    $iterator = new RecursiveDirectoryIterator( $dirPath, RecursiveDirectoryIterator::SKIP_DOTS );
	    $files = new RecursiveIteratorIterator( $iterator, RecursiveIteratorIterator::CHILD_FIRST );
	    foreach( $files as $file ) 
	    {
	        if ( $file->isDir() )
	        {
	            rmdir( $file->getRealPath() );
	        } 
	        else 
	        {
	            unlink( $file->getRealPath() );
	        }
	    }
	    rmdir( $dirPath );
	}

}