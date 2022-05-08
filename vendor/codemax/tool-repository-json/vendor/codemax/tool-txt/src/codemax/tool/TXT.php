<?php
namespace codemax\tool;

/**
 *
 * @author Máximo
 *        
 */
class TXT 
{
	
	/**
	 * 
	 * @var string
	 */
	private $txt = '';
	
	/**
	 *
	 * @param string $text
	 * @return TXT
	 */
	static public function create( string $text ) : TXT
	{
		return new TXT( $text );
	}
	/**
	 * 
	 * @param string $text
	 */
	public function __construct( string $text )
	{
		$this->txt = $text;
	}

	/**
	 * 
	 * @param string $otherText
	 * @return bool
	 */
	public function equals( string $otherText ) : bool
	{
		return $this->txt === $otherText;
	}
	
	/**
	 * Comparación de string segura a nivel binario.
	 * Devuelve < 0 si text es menor que otherText; > 0 si text es mayor que otherText y 0 si son iguales. 
	 * 
	 * @see https://www.php.net/manual/es/function.strcmp.php
	 * 
	 * @param string $otherText
	 * @return bool
	 */
	public function compare( string $otherText ) : int
	{
	    return strcmp( $this->txt, $otherText );
	}
	
	/**
	 *
	 * @param string $otherText
	 * @return bool
	 */
	public function contains( string $otherText ) : bool
	{
	    return strlen( stristr( $this->txt, $otherText ) ) > 0 ;
	}
	
	/**
	 * 
	 * @param string $prefix
	 * @return bool
	 */
	public function startWith( string $prefix ) : bool
	{
		return strncmp( $this->txt, $prefix, strlen( $prefix ) ) === 0;
	}
	
	/**
	 * 
	 * @param string $posfix
	 * @return bool
	 */
	public function endWith( string $posfix ) : bool
	{
		return substr( $this->txt , strlen( $posfix ) * -1 ) == $posfix;
	}
	
	/**
	 *
	 * @param string $separator
	 * @param bool $includeSeparator
	 * @return string
	 */
	public function firstPart( string $separator , bool $includeSeparator = false ) : string
	{
	    $part = '';
	    $position = strpos( $this->txt, $separator );
	    if ( $position !== false ) {
	        $part = substr( $this->txt, 0, ( $includeSeparator ? $position + strlen( $separator ) : $position ) );
	    }
	    return $part;
	}
	
	/**
	 * 
	 * @param string $separator
	 * @param bool $includeSeparator
	 * @return string
	 */
	public function lastPart( string $separator , bool $includeSeparator = false ) : string
	{
	    $part = $this->txt;
		$position = strrpos( $this->txt, $separator );
		if ( $position !== false ) {
		    $part = substr( $this->txt, ( $includeSeparator ? $position : $position + strlen( $separator ) ) );
		}
		return $part;
	}
	
	/**
	 * Convert string to in camel-case, useful for class name patterns.
	 * Pe:  'mAke_mE camel-case pLEase' -> 'MakeMeCamelCasePlease'
	 * @see https://www.php.net/manual/es/function.ucwords.php#117270
	 *
	 * @param string $string
	 * @return string
	 */
	public function toCamelCaseClass() : string
	{
		$this->txt = str_replace( '-', ' ', $this->txt );
		$this->txt = str_replace( '_', ' ', $this->txt );
		$this->txt = ucwords( strtolower( $this->txt ) );
		return str_replace( ' ', '', $this->txt );
	}
	
	/**
	 * Convert string to in camel-case, useful for class variable name patterns.
	 * Pe:  'MAke_mE camel-case pLEase' -> 'makeMeCamelCasePlease'
	 * @see https://www.php.net/manual/es/function.ucwords.php#117270
	 * 
	 * @param string $string
	 * @return string
	 */	
	public function toCamelCaseVariable() : string
	{
		return lcfirst( $this->toCamelCaseClass() );
	}
	
}