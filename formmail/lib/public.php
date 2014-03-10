<?
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	Objective   : functions for all web site development
	Written by : wincodetalker@yahoo.com
   - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

// ---------------------------------------------------------------------------
function	gpc( $str = "" ){
	return get_magic_quotes_gpc() ? stripslashes( $str ) : $str ;
}
	
// ---------------------------------------------------------------------------
function	dump( $msg = "" ) {
	global	$debug; 
	 if( $debug ) print "\n\n<!-- \n        //Debug Info:: $msg -->\n\n" ;
}


// ---------------------------------------------------------------------------
function	PHP_SELF_PATH(){
	$PHP_SELF = getEnv( "SCRIPT_NAME" );
	$sCurPath = substr( $PHP_SELF, 0, ( strlen( $PHP_SELF ) - strlen( basename( $PHP_SELF ) ) ) );
	return strlen( $sCurPath ) ? $sCurPath : "" ;
}


// ---------------------------------------------------------------------------
function	submit( $var ){
	global	$HTTP_POST_VARS, $HTTP_GET_VARS ;
	return ( $HTTP_POST_VARS[ $var ] ) ? trim( $HTTP_POST_VARS[ $var ] ) : trim( $HTTP_GET_VARS[ $var ] );
}


// ---------------------------------------------------------------------------
function	isMail( $email ){
	return ereg( "^(.+)@(.+)\\.(.+)$", $email );
}


// ---------------------------------------------------------------------------
function selected( $var, $val ){
	echo ( $var == $val ) ? "selected" : "";
}


// ---------------------------------------------------------------------------
function checked( $var, $val ){
	echo ( $var == $val ) ? "checked" : "";
}

?>