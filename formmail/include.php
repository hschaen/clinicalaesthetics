<?  // include.php

// - - - Begin: define ISDEBUG variable for include different porgrams( debug or releasing mode ) - - - - - - - - - - - - - -
	$bDebugging = false; 
	$aDebugIP = array( 
		"127.0.0.1" => "localhost",
		"216.18.70.26" => "raymond",
		);
	$bOnlyToMachines = strlen($aDebugIP[ getEnv("REMOTE_ADDR") ]) && $bDebugging ; 
	define( "ISDEBUG" , $bOnlyToMachines ) ;
// - - - End: - - - - - - - - - - - - - -

	//define( "DOCUMENT_ROOT", getEnv( "DOCUMENT_ROOT" ) );
	define( "DOCUMENT_ROOT", dirname( __FILE__) );
// - - - - - - - - - - - - Begin : include files - - - - - - - - - 
	define( "LIBPATH",  ISDEBUG  ?  "/lib/debug/" : "/lib/" );
	require_once( DOCUMENT_ROOT . LIBPATH . "config.php" ); 
	require_once( DOCUMENT_ROOT . LIBPATH . "public.php"  );
	require_once( DOCUMENT_ROOT . LIBPATH . "local.php"  );
// - - - - - - - - - - - - End : include files - - - - - - - - - 

?>