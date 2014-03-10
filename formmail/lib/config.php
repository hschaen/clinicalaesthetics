<?

set_magic_quotes_runtime(0);
error_reporting( E_ERROR | E_WARNING | E_PARSE );
// - - - - - - - - - - - - - - - - - - - - - - - -


define( "ADMIN_MAIL", "s6software@users.sourceforge.net" ); // bug report email

define( "HOST_NAME", getEnv( "HTTP_HOST" ) );
define( "PHP_SELF", getEnv( "SCRIPT_NAME" ) );

define( "SITE_TITLE", "PHP FormMail Generator - A tool to create ready-to-use web forms in a flash" );
define( "SITE_COPY_RIGHT", "Copyright(c) " . ( date("Y")>2003 ? "2003 - " . date("Y") : "2003" ) . " " . SITE_TITLE );

define( "ERR_MISSING", "Missing required field : " );
define( "ERR_EMAIL", "Please type in a valid e-mail address." );
define( "ERR_CREDIT_CARD_NUMBER", "Please check the credit card number." );
define( "ERR_CREDIT_CARD_EXPIRED", "Please check the credit card expiry date." );
define( "ERR_SELECT_UPLOAD", "Please select upload file : " );

define( "FORMMAIL_INI_PATH" , DOCUMENT_ROOT . "/ini/" );

?>